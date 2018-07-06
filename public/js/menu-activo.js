	$(document).ready(function(){
		
		var menus = $(".sidebar-menu a"),
		menuSelect = '',
		existeMenu = 0;

		menus.each(function(){
			var menuAct = this;
			menuAct = $(menuAct);
			var link = menuAct.attr("href");
			
			if(UrlBase == link){
				existeMenu = 1;
				menuSelect = menuAct;
			}
		});

		if(existeMenu == 1){
			var padreFinal = 0,
				padreActual = menuSelect;
			while(padreFinal == 0){0
				padreActual = padreActual.parent();

				if(padreActual.hasClass("sidebar-menu")){
					padreFinal = 1;
				}
				else{
					if(padreActual.hasClass("treeview-menu")){
						padreActual.css("display","block");
					}
					if(padreActual.hasClass("treeview")){
						padreActual.addClass("menu-open");
					}
					if(padreActual.prop("tagName") == "LI"){
						padreActual.addClass("active");
					}
				}
			}
		}

	});