<div class="offcanvas offcanvas-top" tabindex="-1" id="searchForm" aria-labelledby="searchFormLabel">
    <!-- <div class="offcanvas-bg"></div> -->
    <div class="search-wrapper">
        <h2 id="searchFormLabel"><?php _e('Wyszukaj', '_themename') ?></h2>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="<?php _e('Zamknij pole wyszukiwania', '_themename') ?>"></button>
        <p><?php _e('Znajdź to czego szukasz, wprowadź nazwę produktu w pole wyszukiwarki i potwierdź klawiszem „Enter“ lub wciskając przycisk z lupką', '_themename') ?></p>
        <form class="search-form" method="get" action="<?php echo home_url(); ?>" role="search">
            <input class="search-input form-control" type="search" name="s" placeholder="<?php _e( 'Wpisz frazę do wyszukania...', '_themename' ); ?>">
            <button class="search-submit btn btn-circle bg-light" type="submit" role="button"><svg xmlns="http://www.w3.org/2000/svg" width="24.071" height="24.071" viewBox="0 0 24.071 24.071"><path d="M23.905 22.043L18.2 16.336a.558.558 0 00-.4-.165h-.621a9.776 9.776 0 10-1.006 1.006v.623a.578.578 0 00.165.4l5.706 5.7a.565.565 0 00.8 0l1.062-1.062a.565.565 0 00-.001-.795zM9.778 17.3A7.522 7.522 0 1117.3 9.778 7.52 7.52 0 019.778 17.3z"/></svg></button>
        </form>
    </div>
</div>