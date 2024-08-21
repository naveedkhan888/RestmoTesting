(function($) {
    "use strict";
  
    /* --------------------------------------------------
    * side panel
    * --------------------------------------------------*/
      var element = $('#panel-btn'),
      sidebar = $('#side-panel');
  
      function panel_handler() {
          var isActive = !element.hasClass('active');
  
          element.toggleClass('active', isActive);
          sidebar.toggleClass('side-panel-open', isActive);
          $('body').toggleClass('side-panel-active', isActive);
          return false;
      }
  
      $('#panel-btn, .side-panel-close, .panel-overlay').on('click', panel_handler);
  
    /* --------------------------------------------------
    * toggle search
    * --------------------------------------------------*/
    var tgSearch  = function($scope, $){
      $scope.find('.xptf-search').each( function(){
        var selector = $(this);
        selector.find('.toggle_search').on("click", function(){
          $(this).toggleClass( "active" );
          selector.find('.h-search-form-field').toggleClass('show');
          if ($(this).find('i').hasClass( "xp-flaticon-search-1" )) {
            $(this).find('i').removeClass( "xp-flaticon-search-1" ).addClass("xp-flaticon-cancel");
          }else{
            $(this).find('i').removeClass( "xp-flaticon-cancel" ).addClass("xp-flaticon-search-1");
          }
        });
      });
    };
  
    /* --------------------------------------------------
    * mobile menu
    * --------------------------------------------------*/
    var mmenuPanel  = function(){
          var element = $('#mmenu-toggle'),
              mmenu   = $('#mmenu-wrapper');
  
          function mmenu_handler() {
              var isActive = !element.hasClass('active');
  
              element.toggleClass('active', isActive);
              mmenu.toggleClass('mmenu-open', isActive);
              $('body').toggleClass('mmenu-active', isActive);
              return false;
          }
  
          $('#mmenu-toggle, .mmenu-close, .mmenu-overlay').on('click', mmenu_handler);
  
          $('.mmenu-wrapper li:has(ul)').prepend('<span class="arrow"><i class="xp-flaticon-next"></i></span>');
          $(".mmenu-wrapper .mobile_mainmenu > li span.arrow").on('click',function() {
              $(this).parent().find("> ul").stop(true, true).slideToggle()
              $(this).toggleClass( "active" ); 
          });
      };
  
      /**
       * Elementor JS Hooks
       */
      $(window).on("elementor/frontend/init", function () {
  
          /*toggle search*/
          elementorFrontend.hooks.addAction(
              "frontend/element_ready/isearch.default",
              tgSearch
          );
  
          /*mmenu*/
          elementorFrontend.hooks.addAction(
              "frontend/element_ready/imenu_mobile.default",
              mmenuPanel
          );
  
    });
  
  })(jQuery);