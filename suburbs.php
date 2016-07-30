<?php
require 'header.php'
?>
<script>
get("data.php?action=suburblist",function(reply){alert(reply);});
</script>
          <div class="container">
              <div class="page-header">
                  <h1>Compare your suburb!</h1>
              </div>
              <p>See how your suburb stacks up against the rest of Geelong! Select your suburb below to start exploring the data!</p>
              <div class="row">
                  <div class="col-sm-6">
                      <select id="suburb1" class="form-control">
                          <option id="*">All of Geelong</option>
                      </select>
                  </div>
                  <div class="col-sm-6">
                      <select id="suburb2" class="form-control">
                          <option id="*">All of Geelong</option>
                      </select>
                  </div>
              </div>
          </div>
<?php
require 'footer.php'
?>
