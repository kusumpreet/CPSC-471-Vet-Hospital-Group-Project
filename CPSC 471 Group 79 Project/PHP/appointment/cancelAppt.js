function cancelAppt(d, diff, t, p)
    {
    if (diff <= 7)
        {
        let conf = confirm('Do you want to cancel this appointment? You will not get a refund');
        if (conf)
            window.location.href = "../appointment/deleteAppt.php?"
                                 + "client_ID=<?php echo $client_ID;?>"
                                 + "&pet_ID=" + p
                                 + "&date=" + d
                                 + "&time=" + t
                                 ;
        }
    else
        {
        let conf = confirm('Do you want to cancel this appointment? You will receive a refund for your purchase');
        if (conf)
            window.location.href = "../appointment/deleteApptR.php?"
                                 + "client_ID=<?php echo $client_ID;?>"
                                 + "&pet_ID=" + p
                                 + "&date=" + d
                                 + "&time=" + t
                                 ;
        }
    }