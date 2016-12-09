<?php

class Footer{

  private $page, $info;

  function __construct($_page, $_info){

    $this->page = $_page;
    $this->info = $_info;
    echo "<div id='footer'>";
    echo "<br>";
    echo "<a href='index.php'><p class='extra-small same-line'>Home</p></a> |";
    echo "<a href='locations.php'><p class='extra-small same-line'> Locations</p></a> |";
    echo "<a href='membership.php'><p class='extra-small same-line'> Memberships</p></a> |";
    echo "<a href='about-us.php'><p class='extra-small same-line'> About Us</p></a> |";
    echo "<a href='contact.php'><p class='extra-small same-line'> Contact Us</p></a> |";
    echo "<a href='intranet/index.php'><p class='extra-small same-line'> Intranet</p></a>";
    echo "<p id='footer-p'>Ever Health - 550 East Spring St. Columbus, OH 43215 - (614)287-5353 - <a href='mailto:everhealth@everhealth.com'>everhealth@everhealth.com</p>";
    echo "<ul class='share-buttons'>";
    echo "<li><a href='https://www.facebook.com/sharer/sharer.php?u=&t=' title='Share on Facebook' target='_blank' onclick='window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(document.URL) + '&t=' + encodeURIComponent(document.URL)); return false;'><img alt='Share on Facebook' src='assets/social/Facebook.png'></a></li>";
    echo "<li><a href='https://twitter.com/intent/tweet?source=&text=:%20' target='_blank' title='Tweet' onclick='window.open('https://twitter.com/intent/tweet?text=' + encodeURIComponent(document.title) + ':%20'  + encodeURIComponent(document.URL)); return false;'><img alt='Tweet' src='assets/social/Twitter.png'></a></li>";
    echo "<li><a href='https://plus.google.com/share?url=' target='_blank' title='Share on Google+' onclick='window.open('https://plus.google.com/share?url=' + encodeURIComponent(document.URL)); return false;'><img alt='Share on Google+' src='assets/social/Google+.png'></a></li>";
    echo "<li><a href='http://www.tumblr.com/share?v=3&u=&t=&s=' target='_blank' title='Post to Tumblr' onclick='window.open('http://www.tumblr.com/share?v=3&u=' + encodeURIComponent(document.URL) + '&t=' +  encodeURIComponent(document.title)); return false;'><img alt='Post to Tumblr' src='assets/social/Tumblr.png'></a></li>";
    echo "<li><a href='http://www.linkedin.com/shareArticle?mini=true&url=&title=&summary=&source=' target='_blank' title='Share on LinkedIn' onclick='window.open('http://www.linkedin.com/shareArticle?mini=true&url=' + encodeURIComponent(document.URL) + '&title=' +  encodeURIComponent(document.title)); return false;'><img alt='Share on LinkedIn' src='assets/social/LinkedIn.png'></a></li>";
    echo "<li><a href='mailto:everhealth@everhealth.com' title='Send email'><img alt='Send email' src='assets/social/Email.png'></a></li>";
    echo "</ul>";
    echo "</div>";
  }
}
?>
