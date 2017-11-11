</div>
<!-- end of contaienr-->

<footer class="page-footer">
          <div class="container">
            <div class="row">
              <div class="col l6 s12">
                <h5 class="white-text">Footer Content</h5>
                <p class="grey-text text-lighten-4">You can use rows and columns here to organize your footer content.</p>
              </div>
              <div class="col l4 offset-l2 s12">
                <h5 class="white-text">Links</h5>
                <ul>
                  <li><a class="grey-text text-lighten-3" href="#!">Facebook</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Link 2</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Link 3</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Link 4</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="footer-copyright">
            <div class="container">
            © 2017 Copyright eLifestyle
            <a class="grey-text text-lighten-4 right" href="#!">let change life style with e</a>
            </div>
          </div>
        </footer>
<script type="text/javascript" src="{{ url::asset('angularjs/front-app.js') }}"></script>

<script type="text/javascript" src="{{ url::asset('angularjs/angular-local-storage.min.js') }}"></script>
  
  <script src="//unpkg.com/@uirouter/angularjs/release/angular-ui-router.min.js"></script>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<!-- <script src="{{ URL::asset('admin/bower_components/jquery/dist/jquery.min.js') }}"></script> -->

<!-- <script src="{{ URL::asset('admin/bower_components/bootstrap/dist/js/bootstrap.min.js') }} "></script> -->

    
  <!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDveObUCdokitvhKOSVSpk6R-Fwn2WpFA4&callback=initMap"
  type="text/javascript"></script>

<script>
 $(".button-collapse").sideNav();

 $('.modal').modal({
      dismissible: true, // Modal can be dismissed by clicking outside of the modal
      opacity: .5, // Opacity of modal background
      inDuration: 300, // Transition in duration
      outDuration: 200, // Transition out duration
      startingTop: '4%', // Starting top style attribute
      endingTop: '10%', // Ending top style attribute
      ready: function(modal, trigger) { // Callback for Modal open. Modal and trigger parameters available.
        
        console.log(modal, trigger);
      },
      complete: function() {  } // Callback for Modal close
    }
  );

    $('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15, // Creates a dropdown of 15 years to control year,
    today: 'Today',
    clear: 'Clear',
    close: 'Ok',
    format: 'yyyy/mm/dd',
    closeOnSelect: false // Close upon selecting a date,
  });


  // $('select').material_select();


  function initMap() {
        var uluru = {lat:21.192134497641412 , lng: 81.34946823120117};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 15,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
      }

</script>

    </body>
  </html>
        