<div id="footer">
    <div id='innerfooter'>
      <div class="row">
        <div id="footerlinks" class="col-xs-0 col-sm-2"></div>
       <div id="footerlinks" class="col-xs-4 col-sm-2">
         <h4 class="footerLinkHeaders">Links</h4>
         <a href="/">Home</a><br />
         <a href="/help/view">Contact Us</a><br />
         <a href="/help/view">FAQ</a><br />
         <a href="/help/view">About Us</a><br />
       </div>
       <div id="footerlinks" class="col-xs-4 col-sm-2">
         <h4 class="footerLinkHeaders">Associates</h4>
         <a href="https://www.bathcollege.ac.uk/">Bath College</a><br />
         <a href="https://diagnosticquestions.com/">Diagnostic Questions</a><br />
         <a href="http://moodle.bathcollege.ac.uk/moodle/">Moodle</a><br />

       </div>
       <div id="footerlinks" class="col-xs-0 col-sm-2"></div>
       <div id="footerlinks" class="col-xs-4 col-sm-2">
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
       <div id="footerlinks" class="col-xs-0 col-sm-2"></div>
      </div>

        <div id='footertext'>
            <p>Copywright &copy MathsProgression - Online mathematics learning resource</p>
        </div>
        <div id='medialinks'>
            <a href="https://www.facebook.com/MathsProgression-1782215791819800/" class="fa fa-facebook"></a>
            <a href="#" class="fa fa-twitter"></a>
            <a href="#" class="fa fa-google"></a>
            <a href="#" class="fa fa-linkedin"></a>
        </div>
    </div>
</div>
