from kivy.config import Config
Config.set('graphics', 'width', '400')
Config.set('graphics', 'height', '600')

from kivymd.app import MDApp
from kivy.uix.screenmanager import ScreenManager, Screen
from kivy.uix.gridlayout import GridLayout
from kivy.uix.boxlayout import BoxLayout
from kivy.uix.stacklayout import StackLayout
from kivy.uix.label import Label
from kivy.uix.button import Button
from kivy.uix.scrollview import ScrollView
from kivy.graphics import Color, Rectangle
from kivy.metrics import dp
from kivy.uix.image import Image
from kivymd.uix.picker import MDDatePicker
from kivy.properties import StringProperty
import random 
import datetime
import mysql.connector

articles = [
    {
        'title': "How to Keep Your Dog Entertained Indoors",
        'content': "Being stuck at home is disappointing for both you and your dog. We all know an active dog is a happy dog, but even if you can’t get out as much as you’d ideally like to, there’s still plenty you can do at home to help keep your dog stimulated and entertained. Check out our tips below for how you can keep your dog entertained indoors.\n1. Practice short bursts of obedience training each day\n2. Teach your dog a new trick\n3. Give your dog a stuffed Kong or a food-dispensing puzzle toy\n4. Play hide and seek\n5. Find the treats"
    },
    {
        'title': "Here’s How to Keep a Cat from Scratching the Furniture",
        'content': "Scratching is a normal aspect of cat behaviour. In the wild, cats scratch their claws to remove the dead layer of claw (think of it like a cat manicure), which helps to keep their claws sharp for hunting. Scratching also lets them mark their territory. They have scent glands between their claws and the scratch marks themselves are a visual sign to other cats that this area is occupied. Scratching and stretching also help them to keep their bodies in good shape.If they are tearing up your furniture, it’s time to find a solution. We’re here to help.\n1. Provide Scratching Posts\n2. Use Cat Scratch Spray\n3. Use Cat Scratch Tape\n4. Try Socks or Nail Caps\n5.Protect with Vinyl Guards"
    }
]

db = mysql.connector.connect(
    host = "localhost",
    user = "root",
    passwd = "password123",
    database = "animalhospital"
)

mycursor = db.cursor()

screenManager = ScreenManager()

clientLoggedIn = -1
clientLoginAttempted = 0
vetLoggedIn = -1
vetLoginAttempted = 0
adminLoggedIn = -1
adminLoginAttempted = 0

class CLogin(Screen):
    def __init__(self, **kwargs):
        super(CLogin, self).__init__(**kwargs)
        self.clogsubmit = self.ids.clogsubmit.__self__
        return

    def client_login(self, username, password):
        global clientLoggedIn
        global clientLoginAttempted
        global vetLoggedIn
        global adminLoggedIn
        mycursor.execute("select id, username, password from client")
        for x in mycursor:
            if x[1] == username and x[2] == password:
                clientLoggedIn = x[0]
                vetLoggedIn = 0
                adminLoggedIn = 0
                print("logged in as " + x[1])
                clientLoginAttempted = 1
        if clientLoggedIn == -1:
            clientLoginAttempted = 1
        self.update_profile(username)
    def goToMenu(self):
        screenManager.current = 'Menu'
    def goToProfile(self):
        if clientLoggedIn != -1:
            screenManager.current = 'CProfile'
        elif vetLoggedIn != -1:
            screenManager.current = 'VProfile'
        elif adminLoggedIn != -1:
            screenManager.current = 'AProfile'
    
    def update_profile(self, username):
        global clientLoggedIn
        global clientLoginAttempted
        text1 = 'client profile'
        if clientLoggedIn != -1:
            text1 = "You are logged in as user " + username
        elif clientLoginAttempted == 1:
            text1 = "Login failed."
            clientLoginAttempted = 0
        else:
            text1 = "You are not logged in."
        CProfile_instance = self.parent.get_screen('CProfile')
        CProfile_instance.update_label(text1)
        return

class CProfile(Screen):
    def __init__(self, **kwargs):
        super(CProfile, self).__init__(**kwargs)
        self.mainLabel = self.ids.mainLabel.__self__
        self.petStack = self.ids.petStack.__self__
        return
    def update_label(self, text1):
        self.mainLabel.text = text1
        query = "select distinct pet.id, pet.name, pet.sex, pet.species from pet, client where owner_id="
        query = query + str(clientLoggedIn)
        mycursor.execute(query)
        for x in mycursor:
            grid = GridLayout(size_hint=(None, None), size=(dp(200), dp(150)), cols=1)
            petName = Label(text=x[1], size_hint=(None, None), size=(dp(150), dp(40)), color=(0, 0, 0, 1))
            petSex = Label(text="Sex: "+str(x[2]), font_size=15, size_hint=(None, None), size=(dp(150), dp(20)), color=(0, 0, 0, 1))
            petSpecies = Label(text="Species: "+str(x[3]), font_size=15, size_hint=(None, None), size=(dp(150), dp(20)), color=(0, 0, 0, 1))
            #editButton = ShopWindowButton(x[0])
            editButton = Button()
            grid.add_widget(petName)
            grid.add_widget(petSex)
            grid.add_widget(petSpecies)
            #grid.add_widget(editButton)
            self.petStack.add_widget(grid)
        screenManager.current = 'CProfile'
        return
    def goHome(self):
        screenManager.current = 'Home'
    def goToMenu(self):
        screenManager.current = 'Menu'
    def goToProfile(self):
        if clientLoggedIn != -1:
            screenManager.current = 'CProfile'
        elif vetLoggedIn != -1:
            screenManager.current = 'VProfile'
        elif adminLoggedIn != -1:
            screenManager.current = 'AProfile'
    def goToBookApp(self):
        instance = self.parent.get_screen('BookAppointment')
        #instance.update()
        screenManager.current = 'BookAppointment'
    def goToViewApp(self):
        instance = self.parent.get_screen('ViewAppointment')
        instance.update()
        screenManager.current = 'ViewAppointment'

class BookAppointment(Screen):
    def __init__(self, **kw):
        super().__init__(**kw)
        self.date_label = self.ids.date_label.__self__
        self.timeDisplay = self.ids.timeDisplay.__self__
    
    def on_cancelD(self, instance, value):
        self.date_label.text = "You didn't choose a date"
    def on_saveD(self, instance, value, date_range):
        self.date_label.text = "Date chosen: " + str(value) + "\n\nPlease choose a time:"
        self.showTimes(value)
    def show_date_picker(self):
        date_dialog = MDDatePicker()
        date_dialog.bind(on_save=self.on_saveD, on_cancel=self.on_cancelD)
        date_dialog.open()
    
    def showTimes(self, day):
        self.timeDisplay.clear_widgets()
        query = "select * from appointment where day="
        query = query + "'" + str(day) + "'"
        mycursor.execute(query)
        times = [8, 9, 10, 11, 12, 1, 2, 3, 4]
        taken = []
        for x in mycursor:
            taken.append(x[2])
        open = list(set(times) - set(taken))
        for x in open:
            timeB = TimeButton(x, day)
            timeB.text = str(x) + ":00"
            self.timeDisplay.add_widget(timeB)
        
    def goToMenu(self):
        screenManager.current = 'Menu'
    def goToProfile(self):
        if clientLoggedIn != -1:
            screenManager.current = 'CProfile'
        elif vetLoggedIn != -1:
            screenManager.current = 'VProfile'
        elif adminLoggedIn != -1:
            screenManager.current = 'AProfile'

class ViewAppointment(Screen):
    def __init__(self, **kw):
        super().__init__(**kw)
        self.apptView = self.ids.apptView.__self__
    def update(self):
        self.apptView.clear_widgets()
        query = "select * from appointment where client_id="
        query = query + str(clientLoggedIn)
        mycursor.execute(query)
        for x in mycursor:
            appt = Label(size_hint=(1, None), height=dp(40), color=(0,0,0,1), font_size=12)
            appt.text = "Date: " + str(x[1]) + "\nTime: " + str(x[2]) + ":00"
            self.apptView.add_widget(appt)
        
    def goToMenu(self):
        screenManager.current = 'Menu'
    def goToProfile(self):
        if clientLoggedIn != -1:
            screenManager.current = 'CProfile'
        elif vetLoggedIn != -1:
            screenManager.current = 'VProfile'
        elif adminLoggedIn != -1:
            screenManager.current = 'AProfile'

class TimeButton(Button):
    date = StringProperty("")
    def __init__(self, time, d, **kw):
        super().__init__(**kw)
        self.id = time
        self.date = str(d)
    
    def bookTime(self, button):
        #print("booked appt on " + str(button.date) + " and time: " + str(button.id))
        query = "insert into appointment values (" + str(clientLoggedIn)
        query = query + ", '" + str(button.date) + "', " + str(button.id) + ")"
        mycursor.execute(query)
        db.commit()
        screenManager.current = 'CProfile'

class VLogin(Screen):
    def __init__(self, **kwargs):
        super(VLogin, self).__init__(**kwargs)
        self.vlogsubmit = self.ids.vlogsubmit.__self__
        return
    def vet_login(self, username, password):
        global vetLoggedIn
        global vetLoginAttempted
        global clientLoggedIn
        global adminLoggedIn
        mycursor.execute("select SIN, username, password from vet")
        for x in mycursor:
            if x[1] == username and x[2] == password:
                vetLoggedIn = x[0]
                clientLoggedIn = 0
                adminLoggedIn = 0
                print("logged in as " + x[1])
                vetLoginAttempted = 1
        if vetLoggedIn == -1:
            vetLoginAttempted = 1
        self.update_profile()
    def update_profile(self):
        global vetLoggedIn
        global vetLoginAttempted
        if vetLoggedIn != -1:
            print("You are logged in as user " + str(vetLoggedIn))
        elif vetLoginAttempted == 1:
            print("Login failed.")
            vetLoginAttempted = 0
        else:
            print("You are not logged in.")
        VProfile_instance = self.parent.get_screen('VProfile')
        VProfile_instance.showTimes()
        VProfile_instance.update()
        return
    def goToMenu(self):
        screenManager.current = 'Menu'
    def goToProfile(self):
        if clientLoggedIn != -1:
            screenManager.current = 'CProfile'
        elif vetLoggedIn != -1:
            screenManager.current = 'VProfile'
        elif adminLoggedIn != -1:
            screenManager.current = 'AProfile'

class VProfile(Screen):
    def __init__(self, **kwargs):
        super(VProfile, self).__init__(**kwargs)
        self.shiftView = self.ids.shiftView.__self__
        return
    
    def showTimes(self):
        self.shiftView.clear_widgets()
        query = "select * from shift where vet_id="
        query = query + "'" + str(vetLoggedIn) + "'"
        mycursor.execute(query)
        for x in mycursor:
            shift = Label(size_hint=(1, None), height=dp(40), color=(0,0,0,1), font_size=12)
            shift.text = "Date: " + str(x[1])
            print(shift.text)
            self.shiftView.add_widget(shift)
    
    def update(self):
        self.showTimes()
        screenManager.current = 'VProfile'
        return
    def goHome(self):
        screenManager.current = 'Home'
    def goToMenu(self):
        screenManager.current = 'Menu'
    def goToProfile(self):
        if clientLoggedIn != -1:
            screenManager.current = 'CProfile'
        elif vetLoggedIn != -1:
            screenManager.current = 'VProfile'
        elif adminLoggedIn != -1:
            screenManager.current = 'AProfile'

class ALogin(Screen):
    def __init__(self, **kwargs):
        super(ALogin, self).__init__(**kwargs)
        self.alogsubmit = self.ids.alogsubmit.__self__
        return
    def admin_login(self, username, password):
        global adminLoggedIn
        global adminLoginAttempted
        global clientLoggedIn
        global vetLoggedIn
        mycursor.execute("select id, username, password from admin")
        for x in mycursor:
            if x[1] == username and x[2] == password:
                adminLoggedIn = x[0]
                clientLoggedIn = 0
                vetLoggedIn = 0
                print("logged in as " + x[1])
                adminLoginAttempted = 1
        if adminLoggedIn == -1:
            adminLoginAttempted = 1
        self.update_profile()
    def update_profile(self):
        text1 = 'admin profile'
        text2 = 'Does this work'
        screenManager.current = 'AProfile'
        return
    def goToMenu(self):
        screenManager.current = 'Menu'
    def goToProfile(self):
        if clientLoggedIn != -1:
            screenManager.current = 'CProfile'
        elif vetLoggedIn != -1:
            screenManager.current = 'VProfile'
        elif adminLoggedIn != -1:
            screenManager.current = 'AProfile'

class AProfile(Screen):
    def __init__(self, **kw):
        super().__init__(**kw)
        self.date_label = self.ids.date_label.__self__
        self.vetDisplay = self.ids.vetDisplay.__self__
    
    def on_cancelD(self, instance, value):
        self.date_label.text = "You didn't choose a date"
    def on_saveD(self, instance, value, date_range):
        self.date_label.text = "Date chosen: " + str(value)
        query = "select vet.f_name, vet.l_name from shift, vet where day='" + str(value) + "'"
        query = query + " and vet.SIN=shift.vet_id"
        mycursor.execute(query)
        for x in mycursor:
            self.date_label.text = self.date_label.text + "\n\nVet working: " + x[0] + " " + x[1]
        self.date_label.text = self.date_label.text + "\n\nPlease choose a vet:"
        self.showTimes(value)
    def show_date_picker(self):
        date_dialog = MDDatePicker()
        date_dialog.bind(on_save=self.on_saveD, on_cancel=self.on_cancelD)
        date_dialog.open()
    
    def showTimes(self, day):
        self.vetDisplay.clear_widgets()
        query = "select * from vet"
        mycursor.execute(query)
        for x in mycursor:
            vb = VetButton(x[0], day)
            vb.text = x[1] + " " + x[2]
            self.vetDisplay.add_widget(vb)
    def goHome(self):
        screenManager.current = 'Home'
    def goToMenu(self):
        screenManager.current = 'Menu'
    def goToProfile(self):
        if clientLoggedIn != -1:
            screenManager.current = 'CProfile'
        elif vetLoggedIn != -1:
            screenManager.current = 'VProfile'
        elif adminLoggedIn != -1:
            screenManager.current = 'AProfile'

class VetButton(Button):
    date = StringProperty("")
    def __init__(self, vet, d, **kw):
        super().__init__(**kw)
        self.id = vet
        self.date = str(d)
    
    def setShift(self, button):
        #print("booked appt on " + str(button.date) + " and time: " + str(button.id))
        query = "delete from shift where day='" + str(button.date) + "'"
        mycursor.execute(query)
        db.commit()
        query = "insert into shift values (" + str(button.id)
        query = query + ", '" + str(button.date) + "')"
        mycursor.execute(query)
        db.commit()
        
        screenManager.current = 'AProfile'

class Shop(Screen):
    def __init__(self, **kw):
        super(Shop, self).__init__(**kw)
        self.goToCart = self.ids.goToCart.__self__
        self.shopStack = self.ids.shopStack.__self__
        
        mycursor.execute("select * from item")
        for x in mycursor:
            grid = GridLayout(size_hint=(None, None), size=(dp(150), dp(200)), cols=1)
            itemName = Label(text=x[0], size_hint=(None, None), size=(dp(150), dp(40)), color=(0, 0, 0, 1))
            itemPrice = Label(text="$"+str(x[1]), font_size=12, size_hint=(None, None), size=(dp(150), dp(20)), color=(0, 0, 0, 1))
            image = Image(size_hint=(None, None), size=(dp(150), dp(100)))
            image.source = "images/shop/" + x[0] + ".jfif"
            b2 = ShopWindowButton(x[2])
            grid.add_widget(image)
            grid.add_widget(itemName)
            grid.add_widget(itemPrice)
            grid.add_widget(b2)
            self.shopStack.add_widget(grid)
        return
    
    def viewCart(self):
        Cart_instance = self.parent.get_screen('Cart')
        Cart_instance.updateCart()
        screenManager.current = 'Cart'
    def goToMenu(self):
        screenManager.current = 'Menu'
    def goToProfile(self):
        if clientLoggedIn != -1:
            screenManager.current = 'CProfile'
        elif vetLoggedIn != -1:
            screenManager.current = 'VProfile'
        elif adminLoggedIn != -1:
            screenManager.current = 'AProfile'

class ShopWindowButton(Button):
    def __init__(self, itemID, **kwargs):
        super().__init__(**kwargs)
        self.id = itemID
        
    def add_to_cart(self, widget):
        if clientLoggedIn != -1:
            checkQ = "select * from cart where client_ID="
            checkQ = checkQ + str(clientLoggedIn)
            checkQ = checkQ + " and item_ID=" + str(widget.id)
            mycursor.execute(checkQ)
            counter = 0
            quantity = 0
            for x in mycursor:
                counter = counter + 1
                quantity = quantity + int(x[2])
            if counter == 0:
                insertQ = "insert into cart values (" + str(clientLoggedIn)
                insertQ = insertQ + ", " + str(widget.id) + ", 1)"
                mycursor.execute(insertQ)
                db.commit()
            elif counter == 1:
                removeQ = "delete from cart where client_ID="
                removeQ = removeQ + str(clientLoggedIn)
                removeQ = removeQ + " and item_ID=" + str(widget.id)
                mycursor.execute(removeQ)
                db.commit()
                
                insertQ = "insert into cart values (" + str(clientLoggedIn)
                insertQ = insertQ + ", " + str(widget.id) + ", "
                insertQ = insertQ + str(quantity + 1) + ")"
                mycursor.execute(insertQ)
                db.commit()

class Cart(Screen):
    def __init__(self, **kw):
        super(Cart, self).__init__(**kw)
        self.cartStack = self.ids.cartStack.__self__
        
    def updateCart(self):
        self.cartStack.clear_widgets()
        query = "select name, price, id, quantity from cart, item where"
        query = query + " cart.item_ID=item.id and client_ID=" + str(clientLoggedIn)
        mycursor.execute(query)
        for x in mycursor:
            grid = GridLayout(size_hint=(None, None), size=(dp(150), dp(200)), cols=1)
            itemName = Label(text=x[0], size_hint=(None, None), size=(dp(150), dp(30)), color=(0, 0, 0, 1))
            itemPrice = Label(text="$"+str(x[1])+" each", font_size=12, size_hint=(None, None), size=(dp(150), dp(20)), color=(0, 0, 0, 1))
            itemQuantity = Label(text=str(x[3])+" in cart", font_size=12, size_hint=(None, None), size=(dp(150), dp(20)), color=(0, 0, 0, 1))
            image = Image(size_hint=(None, None), size=(dp(150), dp(100)))
            image.source = "images/shop/" + x[0] + ".jfif"
            b2 = CartRemoveButton(x[2])
            grid.add_widget(image)
            grid.add_widget(itemName)
            grid.add_widget(itemPrice)
            grid.add_widget(itemQuantity)
            grid.add_widget(b2)
            self.cartStack.add_widget(grid)

    def orderItems(self):
        query = "select name, price, id, quantity from cart, item where"
        query = query + " cart.item_ID=item.id and client_ID=" + str(clientLoggedIn)
        mycursor.execute(query)
        queries = []
        for x in mycursor:
            insert = "insert into billing values ("
            cost = x[1]*x[3]
            insert = insert + str(cost) + ", " + str(clientLoggedIn) + ", '"
            insert = insert + x[0] + "', '" + str(datetime.datetime.now()) + "', "
            insert = insert + str(x[3]) + ")"
            queries.append(insert)
            print(insert)
        for x in queries:
            mycursor.execute(x) 
        delete = "delete from cart where client_ID=" + str(clientLoggedIn)
        mycursor.execute(delete)
        db.commit()
        screenManager.current = 'Shop'
        
    def viewShop(self):
        screenManager.current = 'Shop'
    def goToMenu(self):
        screenManager.current = 'Menu'
    def goToProfile(self):
        if clientLoggedIn != -1:
            screenManager.current = 'CProfile'
        elif vetLoggedIn != -1:
            screenManager.current = 'VProfile'
        elif adminLoggedIn != -1:
            screenManager.current = 'AProfile'

class CartRemoveButton(Button):
    def __init__(self, itemID, **kwargs):
        super().__init__(**kwargs)
        self.id = itemID
        
    def removeFromCart(self, widget):
        if clientLoggedIn != -1:
            removeQ = "delete from cart where client_ID="
            removeQ = removeQ + str(clientLoggedIn)
            removeQ = removeQ + " and item_ID=" + str(widget.id)
            mycursor.execute(removeQ)
            db.commit()
            #print("remove " + str(widget.id) + " to cart")
            Cart_instance = self.parent.parent.parent.parent.parent.parent.get_screen('Cart')
            Cart_instance.updateCart()
            screenManager.current = 'Cart'

class Blog(Screen):
    def __init__(self, **kw):
        super(Blog, self).__init__(**kw)
        self.blog = self.ids.blog.__self__
        self.title1 = self.ids.title1.__self__
        self.content1 = self.ids.content1.__self__
        self.title2 = self.ids.title2.__self__
        self.content2 = self.ids.content2.__self__
        
        self.title1.text = articles[0]['title']
        self.content1.text = articles[0]['content']
        self.title2.text = articles[1]['title']
        self.content2.text = articles[1]['content']
        return

    def goToMenu(self):
        screenManager.current = 'Menu'
    def goToProfile(self):
        if clientLoggedIn != -1:
            screenManager.current = 'CProfile'
        elif vetLoggedIn != -1:
            screenManager.current = 'VProfile'
        elif adminLoggedIn != -1:
            screenManager.current = 'AProfile'

class Menu(Screen):
    def __init__(self, **kwargs):
        super(Menu, self).__init__(**kwargs)
        self.goToH = self.ids.goToH.__self__
        self.logO = self.ids.logO.__self__
        self.goToC = self.ids.goToC.__self__
        self.goToV = self.ids.goToC.__self__
        self.goToA = self.ids.goToC.__self__
        self.goToShop = self.ids.goToShop.__self__
        self.goToBlog = self.ids.goToBlog.__self__
        return
    def goHome(self):
        screenManager.current = 'Home'
    def logOut(self):
        global clientLoggedIn
        global vetLoggedIn
        global adminLoggedIn
        clientLoggedIn = 0
        vetLoggedIn = 0
        adminLoggedIn = 0
        screenManager.current = 'Home'
    def goToCLog(self):
        screenManager.current = 'CLogin'
    def goToVLog(self):
        screenManager.current = 'VLogin'
    def goToALog(self):
        screenManager.current = 'ALogin'
    def goToShopPage(self):
        screenManager.current = 'Shop'
    def goToBlogPage(self):
        screenManager.current = 'Blog'

class Home(Screen):
    def __init__(self, **kw):
        super(Home, self).__init__(**kw)
        self.menuButton = self.ids.menuButton.__self__
        self.appTypeDisplay = self.ids.appTypeDisplay.__self__
        self.vetDisplay = self.ids.vetDisplay.__self__
        
        mycursor.execute("select * from apptype")
        for x in mycursor:
            grid = GridLayout(cols=1, size_hint=(None, None), size=(dp(100), dp(100)))
            name = AppTypeLabel(x[0]+"\n\n$"+str(x[1])+".00")
            grid.add_widget(name)
            self.appTypeDisplay.add_widget(grid)
        
        mycursor.execute("select * from vet")
        for x in mycursor:
            grid = GridLayout(cols=2, size_hint=(1, None), height=dp(100))
            image = Image()
            name = Label(text=x[1]+" "+x[2], color=(0,0,0,1), font_size=14)
            image = Image(size_hint=(None, None), size=(dp(150), dp(100)))
            image.source = "images/vets/" + x[1] + x[2] + ".jpg"
            grid.add_widget(image)
            grid.add_widget(name)
            self.vetDisplay.add_widget(grid)
            
        
        return
    def goToMenu(self):
        screenManager.current = 'Menu'
    def goToProfile(self):
        if clientLoggedIn != -1:
            screenManager.current = 'CProfile'
        elif vetLoggedIn != -1:
            screenManager.current = 'VProfile'
        elif adminLoggedIn != -1:
            screenManager.current = 'AProfile'

colors = [
    (255/255,204/255,51/255,1),
    (51/255,204/255,255/255,1),
    (153/255,51/255,255/255,1),
    (51/255,255/255,204/255,1),
    (255/255,255/255,51/255,1),
    (255/255,51/255,204/255, 0.8),
    (51/255,102/255,255/255, 1)]

class AppTypeLabel(Label):
    def __init__(self, text, **kwargs):
        super(AppTypeLabel, self).__init__(**kwargs)
        self.text = text
        self.background_color = random.choice(colors)



class AnimalHospitalApp(MDApp):
    def build(self):
        #root widget is abox layout
        self.root = BoxLayout()

        #instantiate the screen objects
        self.Home = Home(name='Home')
        self.Menu = Menu(name='Menu')
        self.Shop = Shop(name='Shop')
        self.Cart = Cart(name='Cart')
        self.Blog = Blog(name='Blog')
        
        self.CLogin = CLogin(name='CLogin')
        self.CProfile = CProfile(name='CProfile')
        self.BookAppointment = BookAppointment(name='BookAppointment')
        self.ViewAppointment = ViewAppointment(name='ViewAppointment')
        
        self.VLogin = VLogin(name='VLogin')
        self.VProfile = VProfile(name='VProfile')
        
        self.ALogin = ALogin(name='ALogin')
        self.AProfile = AProfile(name='AProfile')

        #add the screens to the screenManager
        screenManager.add_widget(self.Home)
        screenManager.add_widget(self.Menu)
        screenManager.add_widget(self.Shop)
        screenManager.add_widget(self.Cart)
        screenManager.add_widget(self.Blog)
        
        screenManager.add_widget(self.CLogin)
        screenManager.add_widget(self.CProfile)
        screenManager.add_widget(self.BookAppointment)
        screenManager.add_widget(self.ViewAppointment)
        screenManager.add_widget(self.VLogin)
        screenManager.add_widget(self.VProfile)
        screenManager.add_widget(self.ALogin)
        screenManager.add_widget(self.AProfile)

        #set the current screen
        screenManager.current = 'Home'

        #add the screenManager to the root widget and return it
        self.root.add_widget(screenManager)
        return self.root


if __name__ == '__main__':
    AnimalHospitalApp().run()
