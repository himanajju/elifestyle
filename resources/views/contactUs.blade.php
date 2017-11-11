@extends('layouts.elifestyle_plan_layout')
@section('content')

  <div class="container" style="
    margin-top: 80px;
    margin-bottom: 80px;">
          <div class="section">

            <p class="caption">Have a question? Don't hesitate to send us a message. Our team will be happy to help you.</p>

            <div class="divider"></div>
            
            <div id="contact-page" class="card">
                <div class="card-image waves-effect waves-block waves-light">
                    <div id="map"></div>
                </div>
                <div class="card-content">                    
                    <a class="btn-floating activator btn-move-up waves-effect waves-light darken-2 right">
                        <i class="mdi-editor-mode-edit"></i>
                    </a>

                    <div class="row">
                      <div class="col s12 m6">
                        <form class="contact-form">
                          <div class="row">
                            <div class="input-field col s12">
                              <input id="name" type="text">
                              <label for="first_name">Name</label>
                            </div>
                          </div>
                          <div class="row">
                            <div class="input-field col s12">
                              <input id="email" type="email">
                              <label for="email">Email</label>
                            </div>
                          </div>
                          <div class="row">
                            <div class="input-field col s12">
                              <input id="website" type="text">
                              <label for="website">Website</label>
                            </div>
                          </div>
                          <div class="row">
                            <div class="input-field col s12">
                              <textarea id="message" class="materialize-textarea"></textarea>
                              <label for="message">Message</label>
                            </div>
                            <div class="row">
                              <div class="input-field col s12">
                                <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Send
                                  <i class="mdi-content-send right"></i>
                                </button>
                              </div>
                            </div>
                          </div>
                        </form>
                      </div>                      
                      <div class="col s12 m6">
                        <ul class="collapsible collapsible-accordion" data-collapsible="accordion">
                          <li>
                            <div class="collapsible-header"><i class="mdi-communication-live-help"></i> FAQ</div>
                            <div class="collapsible-body" style="">
                              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                            </div>
                          </li>
                          <li class="active">
                            <div class="collapsible-header active"><i class="mdi-communication-email"></i> Need Help?</div>
                            <div class="collapsible-body" style="display: none;">
                              <p>We welcome your inquiries at the email address <a mailto="support@geekslabs.com">support@geekslabs.com</a>.We will get in touch with you soon.</p>
                              <p>As a creative studio we believe no client is too big nor too small to work with us to obtain good advantage.By combining the creativity of artists with the precision of engineers we develop custom solutions that achieve results. <a href="http://themeforest.net/user/geekslabs/portfolio" target="_blank">See our work.</a></p>
                            </div>
                          </li>
                          <li>
                            <div class="collapsible-header"><i class="mdi-editor-insert-emoticon"></i> Testimonial</div>
                            <div class="collapsible-body" style="">
                              <blockquote>Fantastic product, my sites all run super fast and the support is excellent!<br>The website you designed helped a lot! </blockquote>
                            </div>
                          </li>
                        </ul>
                      </div>
                    </div>

                </div>
                <div class="card-reveal">
                    <span class="card-title grey-text text-darken-4">Company Name LLC <i class="mdi-navigation-close right"></i></span>
                    <p>Here is some more information about this card.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent at ante gravida, finibus magna non, faucibus mauris. Nulla ut diam et purus varius commodo id at magna. Donec aliquet nulla eu lacus suscipit, id facilisis lorem ultricies.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent at ante gravida, finibus magna non, faucibus mauris. Nulla ut diam et purus varius commodo id at magna. Donec aliquet nulla eu lacus suscipit, id facilisis lorem ultricies.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent at ante gravida, finibus magna non, faucibus mauris. Nulla ut diam et purus varius commodo id at magna. Donec aliquet nulla eu lacus suscipit, id facilisis lorem ultricies.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent at ante gravida, finibus magna non, faucibus mauris. Nulla ut diam et purus varius commodo id at magna. Donec aliquet nulla eu lacus suscipit, id facilisis lorem ultricies.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent at ante gravida, finibus magna non, faucibus mauris. Nulla ut diam et purus varius commodo id at magna. Donec aliquet nulla eu lacus suscipit, id facilisis lorem ultricies.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent at ante gravida, finibus magna non, faucibus mauris. Nulla ut diam et purus varius commodo id at magna. Donec aliquet nulla eu lacus suscipit, id facilisis lorem ultricies.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent at ante gravida, finibus magna non, faucibus mauris. Nulla ut diam et purus varius commodo id at magna. Donec aliquet nulla eu lacus suscipit, id facilisis lorem ultricies.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent at ante gravida, finibus magna non, faucibus mauris. Nulla ut diam et purus varius commodo id at magna. Donec aliquet nulla eu lacus suscipit, id facilisis lorem ultricies.</p>                    
                    <p><i class="mdi-action-perm-identity cyan-text text-darken-2"></i> Manager Name</p>
                    <p><i class="mdi-communication-business cyan-text text-darken-2"></i> 125, ABC Street, New Yourk, USA</p>
                    <p><i class="mdi-action-perm-phone-msg cyan-text text-darken-2"></i> +1 (612) 222 8989</p>
                    <p><i class="mdi-communication-email cyan-text text-darken-2"></i> support@geekslabs.com</p>                    
                </div>
            </div>            
           
      
</div>
@endsection