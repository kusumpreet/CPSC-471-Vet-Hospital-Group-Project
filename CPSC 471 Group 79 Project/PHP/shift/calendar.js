
class Calendar

  {

  //-----------------------------------------------------------------------------------------------

  constructor (url,page_id,page_user)
    {
    this.url = url;
    this.page_id = page_id;
    this.page_user = page_user;
    this.month_names = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    this.calendar_div = document.getElementById("calendar_div");
    this.date = new Date ();
    var today        = new Date ();
    this.archive_oldest = this.fix_zeroes_on_date (today);//today.getFullYear() + '-' + (today_month < 10 ? ('0' + today_month) : today_month) + '-' + (today_day < 10 ? ('0' + today_day) : today_day);
    }

  //-----------------------------------------------------------------------------------------------

  get_days_for_the_previous_month () // 0: sunday

    {

    const return_value = [];

    const year          = this.date.getFullYear();

    const month         = this.date.getMonth();

    const first_weekday = new Date (year, month, 1).getDay();

    const days = first_weekday - 1;

    for (let i = days * -1; i <= 0; i++)

      return_value.push (new Date (year, month, i).getDate());

    return return_value;

    }

  //-----------------------------------------------------------------------------------------------

  get_days_for_the_current_month ()
    {
    const return_value = [];
    const year    = this.date.getFullYear();
    const month   = this.date.getMonth();
    const last_day = new Date (year, month+1, 0).getDate();
    for (let i = 1; i <= last_day; i++)
      return_value.push (i);
    return return_value;
    }

  //-----------------------------------------------------------------------------------------------

  get_days_for_the_next_month (number_of_days_in_the_previous_month, number_of_days_in_the_current_month)

    {

    const return_value = [];

    const days = 42 - (number_of_days_in_the_previous_month.length + number_of_days_in_the_current_month.length);

    for (let i = 1; i <= days; i++)

      return_value.push (i);

    return return_value;

    }

  //-----------------------------------------------------------------------------------------------

  show_days ()

    {

    const days_in_the_previous_month = this.get_days_for_the_previous_month (this.date);

    const days_in_the_current_month  = this.get_days_for_the_current_month (this.date);

    const days_in_the_next_month     = this.get_days_for_the_next_month (days_in_the_previous_month, days_in_the_current_month);

    const days_element = document.getElementById ("days");

    var r = 0;

    var c = 0;

    var todays_date = this.today.getDate ();

    var previous_and_current = days_in_the_previous_month.length + days_in_the_current_month.length;

    var rows = Math.ceil (previous_and_current / 7);

    [...days_in_the_previous_month, ...days_in_the_current_month, ...days_in_the_next_month]

      .forEach (day =>

        {

        var int_day = parseInt (day, 10);

        var date_string = this.fix_zeroes_on_date (new Date (this.date .getFullYear(), this.date .getMonth(), int_day));

        if (r < rows)

          {

          //days_element.insertAdjacentHTML ('beforeend', `<button style="float:left;">${day}</button>`);

          var id = 'w' + r + 'd' + c;

          var fg;

          var value;

          if (   (r === 0      && c <  days_in_the_previous_month.length)

              || (r*7 + c >= previous_and_current))

            {

            fg = 'gray';

            value = '&nbsp;';

            }

          else

            {

            fg = 'blue';

            value = '<b>' + day + '</b>';

            }

 

          var clickable_date;

          if (   (   this.date_month > this.this_month

                  || (   this.date_month === this.this_month

                      && int_day >= todays_date))

              && date_string >= this.archive_oldest)

            {

            clickable_date = true;

            if (this.date_month === this.this_month && int_day === todays_date)

              fg = 'red';

            else

              fg = 'blue';

            }

          else

            {

            clickable_date = false;

            fg = 'gray';

            }

 

          document.getElementById (id).innerHTML = ('<button style="width:35px;color:' + fg + ';"'

                                                    + (clickable_date

                                                       ? ' onclick="javascript:calendar.calendar_click(' + this.date.getFullYear() + ',' + (this.date.getMonth()+1) + ',' + day + ');"'

                                                       : '')

                                                     + '>' + value + '</button>'

                                                    );

          if (++c === 7)

            {

            c = 0;

            r++;

            }

          }

        });

    }

  //-----------------------------------------------------------------------------------------------

  display ()
    {
    var today = new Date ();
    this.date = new Date (today.getFullYear(), today.getMonth(), today.getDay());
    console.log ('Calendar date (' + this.date + ')');
    this.show_calendar ();
    }

  //-----------------------------------------------------------------------------------------------

  show_calendar ()

    {

    this.today      = new Date ();

    this.this_month = this.fix_zeroes_on_date (this.today).substring (0, 7);

    this.date_month = this.fix_zeroes_on_date (this.date ).substring (0, 7);

 

    var page;

    page = '<div id="calendar" class="calendar" style="width:250px;height:190px;">'

         + '  <table id="days" cellspacing="1" cellpadding="1" bgcolor="#000000">'

         + '    <tr>'

         ;

 

//    console.log ('date_month (' + this.date_month + ') arc (' + this.archive_oldest.substring(0, 7) + ')')

    if (this.date_month > this.archive_oldest.substring(0, 7))
      page += '      <td class="title_center" style="cursor:pointer;" onclick="calendar.previous_month();">&lt;&lt;</td>';
    else
      page += '      <td class="title_center">&nbsp;</td>';

    page += '      <td id="month_year" colspan="5" class="title_center" style="font-size:12pt;"></td>';
    page += '      <td class="title_center" style="cursor:pointer;" onclick="calendar.next_month();">&gt;&gt;</td>';

    page += '    </tr>'
          + '    <tr>'
          + '      <td class="header_center">Su</td>'
          + '      <td class="header_center">Mo</td>'
          + '      <td class="header_center">Tu</td>'
          + '      <td class="header_center">We</td>'
          + '      <td class="header_center">Th</td>'
          + '      <td class="header_center">Fr</td>'
          + '      <td class="header_center">Sa</td>'
          + '    </tr>'
          ;

    const days_in_the_previous_month = this.get_days_for_the_previous_month ();

    const days_in_the_current_month  = this.get_days_for_the_current_month ();

    var rows = Math.ceil ((days_in_the_previous_month.length + days_in_the_current_month.length) / 7);

    console.log ('Calendar.display:  p ' + days_in_the_previous_month.length + ' n ' + days_in_the_current_month.length + ' rows ' + rows);

    for (let r = 0; r < rows; r++)

      {

      page += '<tr>';

      for (let c = 0; c < 7; c++)

        page += '<td id="w' + r + 'd' + c + '" class="data" style="width:40px;"></td>';

      page += '</tr>';

      }

    page += '  </table>'

          + '</div>'

          ;

    this.calendar_div.innerHTML = page;

    const month_year = document.getElementById ('month_year');

    month_year.innerHTML = '<b>' + this.month_names [this.date.getMonth()] + ' ' + this.date.getFullYear() + '</b>';

    this.calendar_div.style.display = "block";

    this.show_days ();

    }

  //-----------------------------------------------------------------------------------------------

  previous_month ()

    {

    const year  = this.date.getFullYear();

    const month = this.date.getMonth();

    this.date   = new Date (year, month-1, 1);

    this.show_calendar ();

    }

  //-----------------------------------------------------------------------------------------------

  next_month ()

    {

    const year  = this.date.getFullYear();

    const month = this.date.getMonth();

    this.date   = new Date (year, month+1, 1);

    this.show_calendar ();

    }

  //-----------------------------------------------------------------------------------------------

  calendar_click (year, month, day)

    {

    var today        = new Date ();
    var today_string = this.fix_zeroes_on_date (today);//today.getFullYear() + '-' + (today_month < 10 ? ('0' + today_month) : today_month) + '-' + (today_day < 10 ? ('0' + today_day) : today_day);

    this.date = new Date (year, month-1, day);

    var new_date     = this.fix_zeroes_on_date (this.date);//year + '-' + (month < 10 ? ('0' + month) : month) + '-' + (day < 10 ? ('0' + day) : day);

    if (new_date < today_string)

      alert ('Shifts booked (' + new_date + ') cannot be less than today (' + today_string + ')');
    else
        {
        let new_url = this.url + '?date=' + new_date + '&id=' + this.page_id + "&user=" + this.page_user;
        alert ('Date selected ('+ new_date + ') (' + new_url + ')');
        window.location.href = new_url;
        }
    }

  //-----------------------------------------------------------------------------------------------

  display_today ()

    {

    var today        = new Date ();

    var today_string = this.fix_zeroes_on_date (today);//today.getFullYear() + '-' + (today_month < 10 ? ('0' + today_month) : today_month) + '-' + (today_day < 10 ? ('0' + today_day) : today_day);

    console.log("today's date is: (" + today_string + ")");

    }

  //-----------------------------------------------------------------------------------------------

  display_yesterday ()
    {
    var today = new Date ();
    var yesterday = new Date (today.getFullYear(), today.getMonth(), today.getDate() - 1);
    var yesterday_string = this.fix_zeroes_on_date (yesterday);
    console.log("yesterday's date is: (" + yesterday_string + ")");
    }

  //-----------------------------------------------------------------------------------------------

  fix_zeroes_on_date (date)
    {
    var month  = date.getMonth () + 1;
    var day    = date.getDate ();
    var string = date.getFullYear() + '-' + (month < 10 ? ('0' + month) : month) + '-' + (day < 10 ? ('0' + day) : day);
    return (string);
    }
    

  }







