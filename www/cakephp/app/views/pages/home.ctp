<? echo $javascript->link('http://ajax.googleapis.com/ajax/libs/mootools/1.2.4/mootools-yui-compressed.js', false); ?>
<? echo $javascript->link('http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js', false); ?>
<?// echo $javascript->link('/mootools-1.2.4.js', false); ?>
<?// echo $javascript->link('/jquery-1.4.1.js', false); ?>
<? echo $javascript->link('http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.7/jquery-ui.js', false); ?>
<? //echo $javascript->link('/ui/jquery.ui.widget.js', false); ?>

<!-- mopBox -->
<?
echo $html->css('/mopBox/mopBox-2.5.css');
//echo $javascript->link('/ui/jquery.ui.mouse.js');
//echo $javascript->link('/ui/jquery.ui.draggable.js');
//echo $javascript->link('/ui/jquery.ui.resizable.js');
echo $javascript->link('/mopBox/jquery.pngFix.js');
echo $javascript->link('/mopBox/mopBox-2.5.js'); ?>


<style type="text/css">
		#slideshow-container	{ width:400px; height:250px; position:relative; }
		#slideshow-container img {
			width:400px;
			height:250px;
			display:block;
			position:absolute;
			top:0px;
			left:0px;
			z-index:1;
		}
		.toc					{ position:absolute; right:10px; bottom:2px; z-index:2; display:block; width:20px; background:#FFF; color:#FFF; text-align:center; padding:3px; text-decoration:none; }
		.toc-active				{ background:#999; color:#999999; }
	//	#next					{ position:absolute; bottom:2px; right:10px; z-index:2; display:block; width:20px; background:#FFF; color:#999999; text-align:center; padding:3px; text-decoration:none; }
	//	#previous				{ position:absolute; bottom:2px; right:40px; z-index:2; display:block; width:20px; background:#FFF; color:#999999; text-align:center; padding:3px; text-decoration:none; }
/*
	.mb {
		height: 400px;
		width: 250px;
		text-align: right;
		padding: 10px;
	}
	.mbimg { margin-left: auto; margin-right: auto; display:block; border: 3px solid #eee; padding: 1px; max-width:580px; max-height:380px}
	.mb td, .mb th {vertical-align:top; text-align: left }
	*/
	.prod_img {    border: 3px solid #eee; margin: 0px 5px 5px 0px; left:50%; }
	.imagecenter { text-align: center;} 
</style>

<script type="text/javascript">
	
	// slideshow
	var jq = jQuery.noConflict();
	var SimpleSlideshow = new Class({
		options: {
			showControls: true,
			showDuration: 3000,
			showTOC: true,
			tocWidth: 20,
			tocClass: 'toc',
			tocActiveClass: 'toc-active'
		},
		Implements: [Options,Events],
		initialize: function(container,elements,options) {
			//settings
			this.container = $(container);
			this.elements = $$(elements);
			this.currentIndex = 0;
			this.interval = '';
			if(this.options.showTOC) this.toc = [];
			
			//assign
			this.elements.each(function(el,i){
				if(this.options.showTOC) {
					this.toc.push(new Element('a',{
						text: i+1,
						href: '#',
						'class': this.options.tocClass + '' + (i == 0 ? ' ' + this.options.tocActiveClass : ''),
						events: {
							click: function(e) {
								if(e) e.stop();
								this.stop();
								this.show(i);
							}.bind(this)
						},
						styles: {
							right: 155-((i + 1) * (this.options.tocWidth + 10))
						}
					}).inject(this.container));
				}
				if(i > 0) el.set('opacity',0);
			},this);
			
			//next,previous links
			if(this.options.showControls) {
				this.createControls();
			}
			//events
			this.container.addEvents({
				mouseenter: function() { this.stop(); }.bind(this),
				mouseleave: function() { this.start(); }.bind(this)
			});

		},
		show: function(to) {
			this.elements[this.currentIndex].fade('out');
			if(this.options.showTOC) this.toc[this.currentIndex].removeClass(this.options.tocActiveClass);
			this.currentIndex = ($defined(to) ? to : (this.currentIndex < this.elements.length - 1 ? this.currentIndex + 1 : 0));
			this.elements[this.currentIndex].fade('in');
			if(this.options.showTOC) this.toc[this.currentIndex].addClass(this.options.tocActiveClass);
		},
		start: function() {
			this.interval = this.show.bind(this).periodical(this.options.showDuration);
		},
		stop: function() {
			$clear(this.interval);
		},
		//"private"
		createControls: function() {
			/*var next = new Element('a',{
				href: '#',
				id: 'next',
				text: '>>',
				events: {
					click: function(e) {
						if(e) e.stop();
						this.stop(); 
						this.show();
					}.bind(this)
				}
			}).inject(this.container);
			var previous = new Element('a',{
				href: '#',
				id: 'previous',
				text: '<<',
				events: {
					click: function(e) {
						if(e) e.stop();
						this.stop(); 
						this.show(this.currentIndex != 0 ? this.currentIndex -1 : this.elements.length-1);
					}.bind(this)
				}
			}).inject(this.container);
			*/
		}
	});
	
	/* usage */
	window.addEvent('domready',function() {
		jq("#mopbox").mopBox({'target':'#prod_detail','w':1000,'h':400});
	
	 jq(document).bind("contextmenu",function(e){
        return false;
    });

		var slideshow = new SimpleSlideshow('slideshow-container','#slideshow-container img');
		slideshow.start();
	});
	
	function show_mopbox(divId) {
		jq("#" + divId).click();
	}
	
	function prod_click(product_id){
		jq("#prod_detail").load("<?=$html->webroot?>products/mopbox_form?product_id=" + product_id,
			function(){
				jq("#mopbox").click();
			}
		);
	}
</script>
<div id="main">
    <div id="slideshow-container">
       <a href="<?=$slideshow_url[0]?>"><img src="<?=IMG_ROOT?>slideshow/1.jpg" alt="" /></a>
        <a href="<?=$slideshow_url[1]?>"><img src="<?=IMG_ROOT?>slideshow/2.jpg" alt="" /></a>
        <a href="<?=$slideshow_url[2]?>"><img src="<?=IMG_ROOT?>slideshow/3.jpg" alt="" /></a>
        <a href="<?=$slideshow_url[3]?>"><img src="<?=IMG_ROOT?>slideshow/4.jpg" alt="" /></a>
        <a href="<?=$slideshow_url[4]?>"><img src="<?=IMG_ROOT?>slideshow/5.jpg" alt="" /></a>
    </div>
<br />

</div>


<div id="shortnews">
<div class="news">
    <h3><a href="<?=$adv_url[0]['Advertisement']['url']?>"><img src="<?=$adv_url[0]['Advertisement']['img_url']?>" width="350" height="120" /></a></h3>
</div>
<h3><a href="<?=$adv_url[1]['Advertisement']['url']?>"><img src="<?=$adv_url[1]['Advertisement']['img_url']?>" width="350" height="120"/></a></h3>
</div>
<!--div class="news">
    <h3><a href="#"><img src="http://www.style-arena.jp/images/about/benetton_300_100.jpg" width="350" height="120" /></a></h3>
</div>
<h3><a href="#"><img src="http://202.181.205.142/ch/cam_regist/img/D_banner1.jpg" width="350" height="120"/></a></h3>
</div-->

<div id="line"></div>

<div id="left" class="ui-corner-all">
<h3>News </h3>

<?
for ($i=0;$i<count($news_content);$i++){
		  ?>
		  <li>
		  <a href="<?=$news_content[$i]['URL']?>">
		  <?=$news_content[$i]['Content']?>
			</a>
			</li>
		  <?
		}
		?>

</div>
        
<div id="right">	
<div id="rl">
    <table width="" border="0" cellpadding="10" cellspacing="0">
        <tr>
        	<td width=""><a href="./categorys/menus?cid=<?=$cat_id_by_cat_name['Camera Accessories']?>" border="0"><img src="<?=IMG_ROOT?>images/accessories.gif" alt="" width="250" height="25" /></a></td>
            <td><a href="./categorys/menus?cid=<?=$cat_id_by_cat_name['Camera Inserts']?>" border="0"><img src="<?=IMG_ROOT?>images/inserts.gif" alt="" width="250" height="25" /></a></td>
        </tr>
        <tr>
        	<td><a href="#" onclick="show_mopbox('a_prod_<?=$products['accessory']['Product']['id']?>');return false;">
        	 <div class="imagecenter">
        	 <img class="prod_img" src="<?=prodImagePath().$products['accessory']['Product']['product_id']?>_s.jpg" alt=""   />
        	 </div></a></td>
            <td><a href="#" onclick="show_mopbox('a_prod_<?=$products['insert']['Product']['id']?>');return false;">
             <div class="imagecenter">
             <img class="prod_img" src="<?=prodImagePath().$products['insert']['Product']['product_id']?>_s.jpg" alt=""  />
             </div></a></td>
        </tr>
        <tr>
        	<td><?=$products['accessory']['Product']['name']?></td>
            <td><?=$products['insert']['Product']['name']?><a href="%"></a></td>
        </tr>
        <tr>
        	<td align="right"><a id="a_prod_<?=$products['accessory']['Product']['id']?>" onclick="prod_click('<?=$products['accessory']['Product']['product_id']?>')" href="#">DETAIL</a></td>
            <td align="right"><a id="a_prod_<?=$products['insert']['Product']['id']?>" onclick="prod_click('<?=$products['insert']['Product']['product_id']?>')" href="#">DETAIL</a></td>
        </tr>
    </table>
        
    <table width="" border="0" cellpadding="10" cellspacing="0">
          <tr>
                <td width=""><a href="./categorys/menus?cid=<?=$cat_id_by_cat_name['Camera Bags']?>" border="0"><img src="<?=IMG_ROOT?>images/bags.gif" alt="" width="250" height="25" /></a></td>
                 <td><a href="./categorys/menus?cid=<?=$cat_id_by_cat_name['Camera Straps']?>" border="0"><img src="<?=IMG_ROOT?>images/straps.gif" alt="" width="250" height="25" /></a></td>
      </tr>
              <tr>
                <td><a href="#" onclick="show_mopbox('a_prod_<?=$products['bag']['Product']['id']?>');return false;">
                <div class="imagecenter">
                <img class="prod_img" src="<?=prodImagePath().$products['bag']['Product']['product_id']?>_s.jpg" alt="" />
                </div>
                </a></td>
                <td>
                 <a href="#" onclick="show_mopbox('a_prod_<?=$products['strap']['Product']['id']?>');return false;">
                 <div class="imagecenter">
                <img class="prod_img" src="<?=prodImagePath().$products['strap']['Product']['product_id']?>_s.jpg" alt="" />
                </div>
                 </a>
                  </td>
            </tr>
              <tr>
                <td><?=$products['bag']['Product']['name']?></td>
                <td><?=$products['strap']['Product']['name']?></td>
            </tr>
              <tr>
                <td align="right"><a id="a_prod_<?=$products['bag']['Product']['id']?>" onclick="prod_click('<?=$products['bag']['Product']['product_id']?>')" href="#">DETAIL</a></td>
                <td align="right"><a id="a_prod_<?=$products['strap']['Product']['id']?>" onclick="prod_click('<?=$products['strap']['Product']['product_id']?>')" href="#">DETAIL</a></td>
            </tr>
  </table>
</div>
<p class="border"><a href="companys/info/">For oversea customers, please contact us for further information by email.  <br />
海外客戶如欲索取有關詳情請以電郵通知我們</a>
</p>
</div>

<!-- mopBox -->
<div class="hidden">
	<input type="button" id="mopbox"/>
	<div id="prod_detail">
	</div>
</div>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-17949120-3']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
