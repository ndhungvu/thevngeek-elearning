$(function(){
	var a=$(".col-md-2 .sidebar, .col-md-4 .sidebar");
	320>=window.innerWidth&&($("body").css("fontSize","95%"),$("button").css("fontSize","85%"));
	/iPhone|iPod|iPad/i.test(navigator.userAgent)&&$(".btn-quick-guide").css("display","none");
	$("#pull").unbind("click").on("click",function(b){
		b.preventDefault();
		b.stopPropagation();
		window.scrollTo(0,0);a.toggle("slide")
	})
});
$(function(){
	$(".header-search-box").click(function(a){
		a.stopPropagation()
	});
	$(".magnifying-glass").click(function(a){
		$(".header-search-box").is(":hidden")?(a.stopPropagation(),$(".header-search-box").show().focus(),$(".header-search-box").animate({width:100==$(".header-search-box").width()?"0px":"435px",opacity:1},"slow",function(){0==$(".header-search-box").width()&&$(".header-search-box").hide()})):$el.animate({width:435==$el.width()?"435px":"0px",opacity:.3},"slow",function(){0==$el.width()&&$el.hide()})
	})
});
$(document).on("click",function(a){
	var b=$(".header-search-box");
	b.is(":visible")&&b.animate({width:435==b.width()?"435px":"0px",opacity:.3},"slow",function(){0==b.width()&&b.hide()})
});
(function(a){
	a.extend({scrollToTop:function(){
		var b=!1;a("body").append(a("<a />").addClass("scroll-to-top").attr({href:"#",id:"scrollToTop"}).append(a("<i />").addClass("icon icon-chevron-up icon-white")));
		a("#scrollToTop").click(function(b){
			b.preventDefault();
			a("body, html").animate({scrollTop:0},500);
			return!1
		});
		a(window).scroll(function(){
			var c=a(window).scrollTop();
			35>c?a("#pull").attr("style","top: 24px!important"):35<c&&(c-=10,a("#pull").attr("style","top: "+c+"px!important"));
			b||(b=!0,150<
		a(window).scrollTop()?a("#scrollToTop").stop(!0,!0).addClass("visible"):a("#scrollToTop").stop(!0,!0).removeClass("visible"),b=!1)
		})
	}})
})(jQuery);
(function(a){
	var b={action:function(){},runOnLoad:!1,duration:500},c=!1,e,d={init:function(){
		for(var c=0;c<=arguments.length;c++){
			var e=arguments[c];
			switch(typeof e){
				case "function":b.action=e;break;
				case "boolean":b.runOnLoad=e;
					break;
				case "number":b.duration=e
			}
		}
		return this.each(function(){b.runOnLoad&&b.action();a(this).resize(function(){d.timedAction.call(this)})})},timedAction:function(a,d){var l=function(){var a=b.duration;
		if(c&&(a=b.duration-(new Date-e),0>=a)){clearTimeout(c);c=!1;b.action();
			return
		}
	c=setTimeout(l,a)};
	e=new Date;
	"number"===typeof d&&(b.duration=d);
	"function"===typeof a&&(b.action=a);
	c||l()}};
	a.fn.afterResize=function(a){
		return d[a]?d[a].apply(this,Array.prototype.slice.call(arguments,1)):d.init.apply(this,arguments)
	}
})(jQuery);
(function(){
	var a={initialized:!1,initialize:function(){
		this.initialized||(this.initialized=!0,this.build(),this.events())
		},
		build:function(){
			$.scrollToTop();this.featuredBoxes();this.toggle()
		},
		events:function(){
			$(window).afterResize(function(){a.featuredBoxes()})},featuredBoxes:function(){
				$("div.featured-box").css("height","auto");
				$("div.featured-boxes").each(function(){
					var a=$(this),c=0;$("div.featured-box",a).each(function(){
						$(this).height()>c&&(c=$(this).height())});
						$("div.featured-box",a).height(c)
				}
			)},
		toggle:function(){
			$("section.toggle > label").prepend($("<i />").addClass("icon icon-plus"));
			$("section.toggle > label").prepend($("<i />").addClass("icon icon-minus"));
			$("section.toggle.active > p").addClass("preview-active");
			$("section.toggle.active > div.toggle-content").slideDown(350,function(){});
			$("section.toggle > label").click(function(a){
				var c=$(this).parent(),e=$(this).parents("div.toogle"),d=!1;e.hasClass("toogle-accordion")&&"undefined"!=typeof a.originalEvent&&e.find("section.toggle.active > label").trigger("click");
				c.toggleClass("active");
				if(c.find("> p").get(0)){
					d=c.find("> p");
					a=d.css("height");
					d.css("height","auto");
					var h=d.css("height");
					d.css("height",a)
				}
				a=c.find("> div.toggle-content");
				c.hasClass("active")?($(d).animate({height:h},350,function(){
					$(this).addClass("preview-active")
				}),
				a.slideDown(350,function(){

				})):($(d).animate({height:25},350,function(){
					$(this).removeClass("preview-active")}),a.slideUp(350,function(){

					})
				)}
			)}};
			a.initialize()})();
(function(a){
	a.TryIt=function(b,c){
		var e={url:b},d=this;d.settings={};
		d.compile=function(){
			a(".prettyprint.tryit").click(function(b){
				var c=a(this).text(),e="",g="",h="",m="",k="";
				if(a(this).attr("title")){
					var f=a(this).attr("title").split(",");
					f[0]&&(e=a("#"+f[0].trim()+"").text());
					f[1]&&(g=a("#"+f[1].trim()+"").text());
					f[2]&&(k=f[2],h=a("#"+f[2].trim()+"").text());
					f[3]&&(k=f[3],m=a("#"+f[3].trim()+"").text())
				}
				a("#source").text(c);
				a("#supportsource").text(e);
				a("#utilsource").text(g);
				a("#extrasource").text(h);
				a("#inputs").text(m);
				a("#filename").text(k);
				c=a(this).width()+12;a(this).height();
				e=a(this).offset().left;
				g=a(this).offset().top;
				e=Math.round(e);
				e=b.pageX-e;X=c-e;
				g=Math.round(g);
				g=b.pageY-g;36>=X&&36>=g&&(b.preventDefault(),768>=window.innerWidth?a.colorbox({iframe:!0,reposition:!0,opacity:.35,href:d.settings.url,width:window.innerWidth,height:window.innerHeight}):(a(window).height(),a.colorbox({iframe:!0,reposition:!0,opacity:.35,href:d.settings.url,width:960,height:650})))})
		};
		var h=a(window).innerWidth()/2-320;
		a(".inline").colorbox({
			inline:!0,left:h,width:"615px",opacity:.5
		});
		(function(){
			d.settings=a.extend({},e,c);
			a("body").append('<div id="source" style="display:none;"></div>');
			a("body").append('<div id="supportsource" style="display:none;"></div>');
			a("body").append('<div id="utilsource" style="display:none;"></div>');
			a("body").append('<div id="extrasource" style="display:none;"></div>');
			a("body").append('<div id="inputs" style="display:none;"></div>');
			a("body").append('<div id="filename" style="display:none;"></div>');
			a(".prettyprint.tryit").mousemove(function(b){var e=a(this).width()+12;
				a(this).height();
				var c=a(this).offset().left,d=a(this).offset().top,c=Math.round(c),c=b.pageX-c;
				X=e-c;d=Math.round(d);
				d=b.pageY-d;
				36>=X&&36>=d?a(this).css("cursor","pointer"):a(this).css("cursor","default")
			})
		})()}
	})(jQuery);
$(document).ready(function(){
	var a=location.href;filename=a.substring(a.lastIndexOf(".com")+5);-1==filename.lastIndexOf("")&&(filename+="index");0==$('.sidebar li a[href*= "'+filename+'"]').text().length&&(filename=$(".parent-file").text());if(-1==filename.lastIndexOf("whoiswho")){$('ul.nav-list.primary>li a[href*= "'+filename+'"]').css("color","");$('ul.nav-list.primary>li a[href*= "'+filename+'"]').css("background-color","#d6d6d6");
	$('ul.submenu>li a[href*= "'+filename+'"]').css("color","");
	$('ul.submenu>li a[href*= "'+filename+'"]').css("background-color","#d6d6d6!important");
	$('a[href*= "'+filename+'"]').css("color","");
	$('a[href*= "'+filename+'"]').css("background-color","#d6d6d6!important");
	console.log(filename);
	var b=!1,c=!1;
	$(document).on("click",".cclose",function(a){
		$(".submenu-item").hide();b=!1});
		$("#liTL").click(function(a){
			a.stopPropagation();
			/*$.ajax({
				url:"https://www.tutorialspoint.com/tutorials-submenu"
				}).done(function(a){
				$("#top-sub-menu").html(a);
				b?($(".submenu-item").hide(),b=!1):($(".submenu-item").show(),b=!0,c=!1)
			})*/

			var _html = '<div class="sub-menuu">' +
						        '<a href="/tutorial/academic"><div><i class="fa fa-caret-right"></i> Academic</div></a>' +
						        '<a href="/tutorial/big-data-tutorials"><div><i class="fa fa-caret-right"></i> Big Data &amp; Analytics</div></a>' +
						        '<a href="/tutorial/competitive-exams-tutorials"><div><i class="fa fa-caret-right"></i> Competitive Exams</div></a>' +
						        '<a href="/tutorial/database-tutorials"><div><i class="fa fa-caret-right"></i> Databases</div></a>' +
						        '<a href="/tutorial/digital-marketing-tutorials"><div><i class="fa fa-caret-right"></i> Digital Marketing</div></a>' +
						        '<a href="/tutorial/java-technology-tutorials"><div><i class="fa fa-caret-right"></i> Java Technologies</div></a>' +
						    '</div>' +
						    '<div class="sub-menuu">' +
						        '<a href="/tutorial/maths-tutorials"><div><i class="fa fa-caret-right"></i> Mathematics Tutorials</div></a>' +
						        '<a href="/tutorial/multi-language-tutorials"><div><i class="fa fa-caret-right"></i> Multi Language Tutorials</div></a>' +
						        '<a href="/tutorial/mainframe-tutorials"><div><i class="fa fa-caret-right"></i> Mainframe</div></a>' +
						        '<a href="/tutorial/management-tutorials"><div><i class="fa fa-caret-right"></i> Management</div></a>' +
						        '<a href="/tutorial/microsoft-technologies-tutorials"><div><i class="fa fa-caret-right"></i> Microsoft Technologies</div></a>' +
						        '<a href="/tutorial/questions-and-answers"><div><i class="fa fa-caret-right"></i> Questions and Answers</div></a>' +
						    '</div>' +
						    '<div class="sub-menuu">' +
						        '<a href="/tutorial/misc-tutorials"><div><i class="fa fa-caret-right"></i> Miscellaneous</div></a>' +
						        '<a href="/tutorial/mobile-development-tutorials"><div><i class="fa fa-caret-right"></i> Mobile Development</div></a>' +
						        '<a href="/tutorial/computer-programming-tutorials"><div><i class="fa fa-caret-right"></i> Programming</div></a>' +
						        '<a href="/tutorial/scripting-lnaguage-tutorials"><div><i class="fa fa-caret-right"></i> Scripts</div></a>' +
						        '<a href="/tutorial/soft-skill-tutorials"><div><i class="fa fa-caret-right"></i> Soft Skills</div></a>' +
						        '<a href="/tutorial/sap-tutorials"><div><i class="fa fa-caret-right"></i> SAP</div></a>' +
						    '</div>' +
						    '<div class="sub-menuu" style="border-right:none;">' +
						        '<a href="/tutorial/sports-tutorials"><div><i class="fa fa-caret-right"></i> Sports</div></a>' +
						        '<a href="/tutorial/software-quality-tutorials"><div><i class="fa fa-caret-right"></i> Software Quality</div></a>' +
						        '<a href="/tutorial/telecom-tutorials"><div><i class="fa fa-caret-right"></i> Telecom</div></a>' +
						        '<a href="/tutorial/web-development-tutorials"><div><i class="fa fa-caret-right"></i> Web Development</div></a>' +
						        '<a href="/tutorial/xml-technologies-tutorials"><div><i class="fa fa-caret-right"></i> XML Technologies</div></a>' +
						    '</div>' +
						    '<div class="viewall" style="background:#eee;">' +
						        '<a href="/tutorial"><i class="fa-hand-o-right"></i> View All</a>' +
						    '</div>' +
						    '<div id="cclosed" class="cclose"><i class="fa-close"></i></div>';
			$("#top-sub-menu").html(_html);
			b?($(".submenu-item").hide(),b=!1):($(".submenu-item").show(),b=!0,c=!1)
		});
		$("#liBlog").click(function(a){
			a.stopPropagation();
			var _html = '<div class="sub-menuu">' +
                                '<img src="http://media.blogradio.vn//Upload/CMS/Nam_2017/Thang_3/Ngay_31/Images/488-blogradio-yeu-cham-thoi-1.jpg"/>' +
                                '<h3>Nếu em nói thật vào ngày Cá tháng tư, anh có tin không?</h3>' +
                            '</div>' +
                            '<div class="sub-menuu">' +
                                '<img src="http://media.blogradio.vn//Upload/CMS/Nam_2017/Thang_3/Ngay_31/Images/488-blogradio-yeu-cham-thoi-1.jpg"/>' +
                                '<h3>Nếu em nói thật vào ngày Cá tháng tư, anh có tin không?</h3>' +
                            '</div>' +
                            '<div class="sub-menuu">' +
                                '<img src="http://media.blogradio.vn//Upload/CMS/Nam_2017/Thang_3/Ngay_31/Images/488-blogradio-yeu-cham-thoi-1.jpg"/>' +
                                '<h3>Nếu em nói thật vào ngày Cá tháng tư, anh có tin không?</h3>' +
                            '</div>' +
                            '<div class="sub-menuu">' +
                                '<img src="http://media.blogradio.vn//Upload/CMS/Nam_2017/Thang_3/Ngay_31/Images/488-blogradio-yeu-cham-thoi-1.jpg"/>' +
                                '<h3>Nếu em nói thật vào ngày Cá tháng tư, anh có tin không?</h3>' +
                            '</div>' +
                            '<div class="viewall" style="background:#eee;">' +
                              '<a href="/tutorialslibrary"><i class="fa-hand-o-right"></i> View All</a>' +
                        	'</div>' +
                        	'<div id="cclosed" class="cclose"><i class="fa-close"></i></div>';
			$('#top-sub-menu').html(_html);
			b?($(".submenu-item").hide(),b=!1):($(".submenu-item").show(),b=!0,c=!1)
		});
		$("#liCG").click(function(a){
			a.stopPropagation();
			$.ajax({
				url:"codingground-submenu"}).done(function(a){
					$("#top-sub-menu").html(a);
					c?($(".submenu-item").hide(),c=!1):($(".submenu-item").show(),c=!0,b=!1)
				})
			});
		$(document).on("click",function(a){
			a=$(".submenu-item");
			a.is(":visible")&&(a.hide(),b=!1)
		});
		$(".no-sub-menu").on("click",function(a){
			a=$(".submenu-item");a.is(":visible")&&a.hide()
		});
		$("form button.btn").on("click",function(){$(this).find("a").attr("href")&&(window.location.href=$(this).find("a").attr("href"))})}
	});
	$(window).load(function(){
		$(".middle-col").height()<$(".sidebar").height()&&991<window.innerWidth&&$(".middle-col").css("height",$(".sidebar").height()+50);
		$(".middle-col").height()<$("#rightbar").height()&&991<window.innerWidth&&$(".middle-col").css("height","1171");
		/iPhone|iPad|iPod/i.test(navigator.userAgent)&&($(".android").hide(),$(".microsoft").hide(),$(".hide-me").hide())});
		function resizeFrame(a){
			a.height="200px";
			a.height=a.contentWindow.document.body.scrollHeight+5+"px"
		}
	468>window.innerWidth&&($(".topgooglead").html(""),$(".topgooglead").html('<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js">\x3c/script><ins class="adsbygoogle" style="display:inline-block;width:300px;height:250px" data-ad-client="ca-pub-7133395778201029" data-ad-slot="8354544120"></ins><script>(adsbygoogle = window.adsbygoogle || []).push({});\x3c/script>'));


/*-- Modal --*/
function modalPopup(item, modal) {
	item.onclick = function() {
	    modal.style.display = "block";
	    window.onclick = function(event) {
		    if (event.target == modal) {
		        modal.style.display = "none";
		    }
		}
	}
	
	$('.jsClose').on('click', function() {
		modal.style.display = "none";
	})
}
