<?php
  require("page.php");

  $homepage = new Page();

  $homepage->content ="<!-- page content -->
                       <section>
                       <h2>Welcome to the home of Cozy Home Interiors Ltd.</h2>
                       <p>Please take some time to get to know us.</p>
                       <p>We specialize in interior design and decor
                       and hope to hear from you soon.</p>
                       </section>";
  $homepage->Display();
?>