 <nav class="navbar navbar-expand navbar-dark bg-dark">
     <div class="container container-fluid">
         <a class="navbar-brand">VVSU-Chatbot CP</a>
         <div class="collapse navbar-collapse" id="navbarNav">
             <div class="collapse navbar-collapse" id="navbarNav">
                 <ul class="navbar-nav">
                     <li class="nav-item">
                         <a class="nav-link <?php if ($page == "main") echo "active" ?>" href="index.php"><i class="fa fa-cubes" aria-hidden="true"></i> Дерево диалога</a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link <?php if ($page == "keys") echo "active" ?>" href="keys.php"><i class="fa fa-key-modern" aria-hidden="true"></i> Ключи</a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link <?php if ($page == "phones") echo "active" ?>" href="phones.php"><i class="fa fa-phone" aria-hidden="true"></i> Телефоны</a>
                     </li>
                 </ul>
             </div>
         </div>
         <form method="post" action="/">
             <input type="hidden" name="a" value="logout">
             <button type="submit" href="?a=logout" class="btn btn btn-secondary">Выход</button>
         </form>
     </div>
 </nav>