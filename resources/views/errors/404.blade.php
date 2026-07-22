<!DOCTYPE html>
<html>
    <head>
        <title>Erreur 404</title>

        @include('css_js')

    </head>
    <body>
        <div class="container">
            <div class="content" align="center">
                <div class="title">
                    <br><br><br><br><br><br><br><br><br><br><br><br><br>

                    <h2>Ouupss ! Erreur 404</h2>
                    <a href="{{ URL::previous() }}" class="btn btn-warning">&nbsp;&nbsp;&nbsp;Retour&nbsp;&nbsp;&nbsp;</a>

                </div>
            </div>
            <footer class="footer_section" id="contact" >

                <div class="container">
                    <div class="footer_bottom"> <span>Copyright © 2016 | <a href="https://www.homsys.ma/">HOMSYS</a>  </span> </div>

                </div>
            </footer>
        </div>
    </body>
</html>
