	<footer class="site-footer">

		&copy; <?= date('Y') ?>

		<a href="<?= $site->url() ?>"><?= $site->title() ?></a>

		<?php foreach( $site->children()->unlisted() as $item ):
			switch ( $item->intendedTemplate()->name() ) {
				case 'error':
				case 'index':
					continue 2;
			}
			?>
			<a href="<?= $item->url() ?>"><?= $item->title()->html() ?></a>
		<?php endforeach; ?>

		<?php snippet('fields/links',[
			'links' => $site->links()
		]); ?>

		<?php if( $info = page('info') ): ?>
			<?= $info->imprint()->toAnchor('Imprint') ?>
		<?php endif; ?>

	</footer>

	<?= js('assets/js/stickyBits.min.js') ?>
	<script>
		stickybits('.sticky', { useStickyClasses: true });
	</script>

	<?= js('assets/js/swiper.min.js') ?>

	<script>

		const swiperOptions = {
			speed: 700,
			spaceBetween: 200,
			loop: true,
			lazy: true,
			grabCursor: true,
			initialSlide: 0,
			navigation: {
		    nextEl: '.swiper-button-next',
		    prevEl: '.swiper-button-prev',
		  },
			pagination: {
        el: '.swiper-pagination',
				type: 'fraction',
      },
			keyboard: {
		    enabled: true,
		    onlyInViewport: true,
		  },
		};

		const gContainer = document.querySelector('.gallery');
		let gSwiper, figures;

		if( gContainer && gContainer.classList.contains('multiple') ){

			figures = gContainer.getElementsByTagName('FIGURE');
			startSwiper();

			gContainer.querySelector( '.swiper-button-index' ).addEventListener( 'click', ()=>{
				if( gContainer.classList.contains('index') ){
					startSwiper();
				} else {
					showIndex();
				}
			}, false );

		}

		function startSwiper( i = 0 ){
			console.log('show slider', i);

			gContainer.classList.remove('index');
			gContainer.classList.add('swiper-container');

			for (var figure of figures) {
				figure.removeEventListener( 'click', clickOnIndex );
			}

			swiperOptions.initialSlide = i;
			gSwiper = new Swiper( gContainer, swiperOptions );
		}

		function showIndex(){
			console.log('show index');

			gSwiper.destroy();
			gSwiper = undefined;

			gContainer.classList.remove('swiper-container');
			gContainer.classList.add('index');

			for (var figure of figures) {
				figure.addEventListener( 'click', clickOnIndex, false );
			}

		}

		function whatN(element, type){
	    let i = 0;
      while( element = element.previousElementSibling ){
        i++;
      }
	    return i;
		}

		function clickOnIndex( event ){

			let slide = event.target.closest('.swiper-slide');
			let i = whatN( slide );

			startSwiper( i );

		}

	</script>

	<script>
		// replace slashes
		let replaceSlashes = document.querySelectorAll('.title,.subtitle,.date,.replaceSpecialChars');
		console.log( replaceSlashes );
		for (let element of replaceSlashes) {
			let html = element.innerHTML;
			html = html.replace(/(\/)(?!([^<]+)?>)/g,"<i class=\"special slash\"><i>/</i></i>");
			html = html.replace(/-(?!([^<]+)?>)/g,"<i class=\"special minus\"><i>-</i></i>");
			html = html.replace(/–(?!([^<]+)?>)/g,"<i class=\"special dash\"><i>–</i></i>");
			html = html.replace(/_(?!([^<]+)?>)/g,"<i class=\"special lodash\"><i>_</i></i>");
			html = html.replace(/\|(?!([^<]+)?>)/g,"<i class=\"special pipe\"><i>|</i></i>");
			element.innerHTML = html;
		}
	</script>

</body>
</html>
