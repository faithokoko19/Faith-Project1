<?php
  require ("page.php");

  class ServicesPage extends Page
  {
    private $row2buttons = array(
                           "Remodeling" => "remodelling.php",
                           "House Plans" => "houseplans.php",
                           "Decorating" => "decorate.php",
                           "Lighting Installation" => "lights.php"
                           );

    public function Display()
    {
      echo "<html>\n<head>\n";
      $this->DisplayTitle();
      $this->DisplayKeywords();
      $this->DisplayStyles();
      echo "</head>\n<body>\n";
      $this->DisplayHeader();
      $this->DisplayMenu($this->buttons);
      $this->DisplayMenu($this->row2buttons);
      echo $this->content;
      $this->DisplayFooter();
      echo "</body>\n</html>\n";
    }
  }

  $services = new ServicesPage();

  $services -> content ="<p>At Cozy Home Interiors, we offer a number
  of services.We can remodel your entire house or specific rooms such as kitchens, bathrooms, living rooms and bedrooms. 
We can draw and revise house plans. We also decorate homes. If you want lighting installed, we are here for you.</p>";

  $services->Display();
?>
