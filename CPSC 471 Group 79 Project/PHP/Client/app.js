const navSlide = () => {
    const burger = document.querySelector('.burger');
    const nav = document.querySelector('.nav-links');
    const navLinks = document.querySelectorAll('.nav-links li');

    burger.addEventListener('click', () => {
        //Toggle nav
        nav.classList.toggle('nav-active');
        //document.body.style.overflow = 'hidden';

        //Animate Links
        navLinks.forEach((link,index) => {
            if(link.style.animation){
                link.style.animation = '';
            } else{
                link.style.animation = `navLinkFade 0.5s ease forwards ${index / 7 + 0.3}s`;
            }
        });
        //Burger Animation
        burger.classList.toggle('toggle');
        
    });
}

navSlide();

function togglePopup()
    {
    document.getElementById("popup-1").classList.toggle("active");
    }

function refresh_page (seconds, url)
    {
    setTimeout(function ()
        {    
        window.location.href = url; 
        }, seconds*1000);
    }
