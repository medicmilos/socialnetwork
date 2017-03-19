<script>
    $(document).ready(function () {

        var docHeight = $(window).height(); //screen size
        var footerHeight = $('#footer').height(); //footer size
        var footerTop = $('#footer').position().top + footerHeight;

        if (footerTop < docHeight) {
            $('#footer').css('margin-top', 10 + (docHeight - footerTop) + 'px');
        }

    });
</script>
<div class="navbar-bottom" id="footer">
    <div class="container footer-container">
        <div class="row equal">
            <div class="col-xs-12 text-center col-sm-3">
                <a>Sn </a>© 2017
            </div>
            <div class="col-xs-12 text-center col-sm-5">

                <?php if (isset($footerMenu)): ?>
                    <ul class="navbar-nav">
                        <?php foreach ($footerMenu as $link): ?>
                            <li>
                                <?php print anchor($link->link, $link->name); ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>	

            </div> 
            <div class="col-xs-12 text-center col-sm-4">
                Language: <span>English </span> 
            </div>
        </div>
    </div>
</div>
</body>
</html>