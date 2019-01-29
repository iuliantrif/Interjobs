<div id = "header">
   <div id='cssmenu' class = "container">
      <ul class="nav nav-tabs" id="taguri" >
         <?php
            if (!empty($_SESSION)) {
               $tip = $_SESSION['tip'];
            }else{
               $tip = 5;
            }


         ?>
         <li role="presentation"><a href='index.php?pagina=homepage1'><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
         <li role="presentation"><a href='index.php?pagina=companies'>Partner companies</a></li>
         
           <?php if ($tip == '5'){ ?>
               <li role=" presentation"><a href='index.php?pagina=What_do_we_offer'>What do we offer ?</a></li>
               <li role="presentation" ><a href="index.php?pagina=Login">Log In</a></li>
               <li role="presentation" ><a href="index.php?pagina=register">Register</a></li>
            <?php } ?>
         <!--
         0 - user normal
         1-companie normala
         2-companie sponsor
         3-user sponsor
         4-developer
         5- nelogat
      -->
         <?php if($tip != '5') { ?>   
            <?php if ($_SESSION['tip'] == '0') { ?>
               <li role="presentation" ><a href="index.php?pagina=Profile">Your Profile</a></li>
               <li role="presentation" ><a href="index.php?pagina=events">Events</a></li>
               <li role="presentation" ><a href="index.php?pagina=anunturi">Offers</a></li>
               <?php if (!empty($_GET['id'])) { ?>
                  <li role="presentation"><a href="index.php?pagina=chat">Chat</a></li>
               <?php } ?>
               <li role="presentation" ><a href="index.php?pagina=other_user">Search <span class="glyphicon glyphicon-search" aria-hidden="true"></span></a></li>
               
               <li role="presentation"><a href='index.php?pagina=friend_requests'>Friend Requests</a></li>
               <li role="presentation" id = "div_logout" ><a href="index.php?pagina=logout">Log out</a></li> 
            <?php } if ($_SESSION['tip'] == '1') { ?>
               <li role="presentation" ><a href="index.php?pagina=Profile">Your company's profile</a></li>
               <li role="presentation" ><a href="index.php?pagina=events">Events</a></li>
               <li role="presentation" ><a href="index.php?pagina=other_user">Search</a></li>
               <li role="presentation"><a href='index.php?pagina=friend_requests'>Friend Requests</a></li>
               <li role="presentation" id = "div_logout" ><a href="index.php?pagina=logout">Log out</a></li> 

            <?php }if ($_SESSION['tip'] == '2') { ?>
               <li role="presentation" ><a href="index.php?pagina=Profile">Your company's profile</a></li>
               <li role="presentation" ><a href="index.php?pagina=devBlog">Developers blog</a></li>
               <li role="presentation" ><a href="index.php?pagina=events">Events by Devs</a></li>
               <li role="presentation" ><a href="index.php?pagina=events">Events</a></li>
               <li role="presentation" ><a href="index.php?pagina=other_user">Search</a></li>
               <li role="presentation"><a href='index.php?pagina=friend_requests'>Friend Requests</a></li>
               <li role="presentation" id = "div_logout" ><a href="index.php?pagina=logout">Log out</a></li> 
            
            <?php } if ($_SESSION['tip'] == '3') { ?>
               <li role="presentation" ><a href="index.php?pagina=Profile">Your Profile</a></li>
               <li role="presentation" ><a href="index.php?pagina=events">Developers blog</a></li>
               <li role="presentation" ><a href="index.php?pagina=events">Events by Devs</a></li>
               <li role="presentation" ><a href="index.php?pagina=events">Events</a></li>
               <li role="presentation" ><a href="index.php?pagina=anunturi">Offers</a></li>
               <li role="presentation" ><a href="index.php?pagina=anunturi">Offers by partners</a></li>
               <li role="presentation"><a href='index.php?pagina=friend_requests'>Friend Requests</a></li>

               <?php if (!empty($_GET['id'])) { ?>
                  <li role="presentation"><a href="index.php?pagina=chat">Chat</a></li>
               <?php } ?>
               <li role="presentation" ><a href="index.php?pagina=other_user">Search <span class="glyphicon glyphicon-search" aria-hidden="true"></span></a></li>
               <li role="presentation" id = "div_logout" ><a href="index.php?pagina=logout">Log out</a></li>
            
            <?php } if ($_SESSION['tip'] == '4') { ?>
               <li role="presentation" ><a href="index.php?pagina=Profile">Your Profile</a></li>
               <li role="presentation" ><a href="index.php?pagina=devBlog">Dev blog</a></li>
               <!--<li role="presentation" ><a href="index.php?pagina=events">Events by Developers UC</a></li>-->
               <li role="presentation" ><a href="index.php?pagina=events">Events</a></li>
               <li role="presentation" ><a href="index.php?pagina=anunturi">Offers</a></li>
               <!--<li role="presentation" ><a href="index.php?pagina=anunturi">Offers by partner companies</a></li>-->
               <li role="presentation" ><a href="index.php?pagina=anunturi">Dev chat</a></li>
               <?php if (!empty($_GET['id'])) { ?>
                  <li role="presentation"><a href="index.php?pagina=chat">Chat</a></li>
               <?php } ?>
               <li role="presentation" ><a href="index.php?pagina=other_user">Search <span class="glyphicon glyphicon-search" aria-hidden="true"></span></a></li>
               <li role="presentation"><a href='index.php?pagina=friend_requests'>Friend Requests</a></li>
               <li role="presentation" id = "div_logout" ><a href="index.php?pagina=logout">Log out</a></li>
            <?php } 
         else{?>
            
         <?php }?>

      <?php }?>
      </ul>

   </div>
</div>
