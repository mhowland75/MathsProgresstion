<div id="footer">
    <div id='innerfooter'>
      <div class="row">
        <div id="footerlinks" class="col-sm-2"></div>
       <div id="footerlinks" class="col-sm-2">
         <h4 class="footerLinkHeaders">Links</h4>
         <a href="#">Home</a><br />
         <a href="#">Contact Us</a><br />
         <a href="#">FAQ</a><br />
         <a href="#">About Us</a><br />
       </div>
       <div id="footerlinks" class="col-sm-2">
         <h4 class="footerLinkHeaders">Associates</h4>
         <a href="#">Bath College</a><br />
         <a href="#">Diagnostic Questions</a><br />
         <a href="#">Moodle</a><br />

       </div>
       <div id="footerlinks" class="col-sm-2"></div>
       <div id="footerlinks" class="col-sm-2">
         <h4 class="footerLinkHeaders">Staff</h4>
         @if (Auth::guest())
         <li><a href="{{ route('login') }}">Login</a></li><br />

         @else
         <a href="{{ route('logout') }}"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            Logout</a>
         <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
             {{ csrf_field() }}
         </form>
                @endif
       </div>
       <div id="footerlinks" class="col-sm-2"></div>
      </div>

        <div id='footertext'>
            <p>Copywright &copy Michael Howland - Web Development Artisan </p>
        </div>
        <div id='medialinks'>
            <a href="#" class="fa fa-facebook"></a>
            <a href="#" class="fa fa-twitter"></a>
            <a href="#" class="fa fa-google"></a>
            <a href="#" class="fa fa-linkedin"></a>
        </div>
    </div>
</div>
