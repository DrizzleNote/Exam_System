var EDWIN = {};       //全局变量
function getTabIndex(content){
   if(content === 'content-main' || content === 'content-edit'){
       return 0;
   }else{
       var capacity = 15; //允许多少tab页面，超过则覆盖
       if(undefined === EDWIN.infoTabIndex){
           EDWIN.infoTabIndex = 0;
       }else{
           EDWIN.infoTabIndex++;
           EDWIN.infoTabIndex = EDWIN.infoTabIndex % capacity;
       }
       return EDWIN.infoTabIndex;
   }
}

$(function () {

    $(window).on("hashchange load", function () {
        if(!window.location.hash.substr(1)){
            window.location.hash = $('#J_mainTabs div.page-tabs-content a.content-main[data-index="0"]').attr('data-id');
        }
        tabCheck();
    });
    function sumWidth(WidthObjList) {
        var width = 0;
        $(WidthObjList).each(function () {
            width += $(this).outerWidth(true)
        });
        return width
    };
    function getUrlParam(url){
        var param = {};
        var paramStr = url.substr(url.indexOf('?')+1);
        var equation = paramStr.split('&');
        $.each(equation,function(){
           var kval = this.split('=');
            kval[1] = (kval[1]).replace('+', ' ');
            if(kval[1] === 'false') kval[1] = false;
            if(kval[1] === 'true')  kval[1] = true;
            param[kval[0]] = kval[1];
        });
        return param;
    }
    function tabCheck() {
        var newTab = true;
        var url,param;
        url = window.location.hash.replace('#', '');
        param = getUrlParam(url);
        if (url == undefined || $.trim(url).length == 0) {
            return false
        }
        var tab = $('#J_mainTabs div.page-tabs-content a.J_menuTab.'+param.content+'[data-id="#'+url+'"]');
        var content = $('#J_mainContent .J_content.'+param.content+'[data-id="#'+url+'"]');
        if(tab.length){
            if (!$(tab).hasClass("active")) {
                $(tab).addClass("active").siblings(".J_menuTab").removeClass("active");
                fixTab(tab);
            }
        }
        if(content.length || content.is('iframe')){
            $(content).show().siblings(".J_content").hide();
            newTab = false;
        }

        if ( !tab.length || !content.length || newTab || param.refresh) {
            tabCreate(url,param);
            fixTab($("#J_mainTabs .J_menuTab.active"))
        }
        return false
    };
    function tabCreate(url,param) {
        url = url.replace('#', '');
        var index = getTabIndex(param.content);
        var tabsContent = $('#J_mainTabs div.page-tabs-content');
        var tab = tabsContent.find('a.J_menuTab.'+param.content+'[data-index="'+index+'"]');
        var content = $('#J_mainContent div.J_content.'+param.content+'[data-index="'+index+'"]');
        var J_tabhtml,J_contenthtml;
        J_tabhtml = '<a href="javascript:;" class="active J_menuTab"></a>';
        var closeBtn = (param.content === 'content-main')? '' : '<i class="fa fa-times-circle"></i>';
        if(param.content != 'content-main' && param.content != 'content-edit'){
            param.content = 'content-info';
        }
        $(tabsContent).find('a.J_menuTab').removeClass('active');
        if($(tab).length <= 0){
            $(tabsContent).append(J_tabhtml);
            $(tabsContent).find('a.J_menuTab.active').addClass(param.content).attr('data-index',index).attr('data-id','#'+url).text(param.title).append(closeBtn);
        }else{
            $(tab).addClass('active').attr('data-id','#'+url).text(param.title).append(closeBtn);
        }
        if(param.isExtUrl || param.iframe){
            J_contenthtml = '<iframe class="J_content active" width="100%" height="100%" frameborder="0" src="'+ url+'" seamless></iframe>';
        }else{
            J_contenthtml = '<div class="J_content active"></div>';
        }
        $('#J_mainContent .J_content').removeClass('active').hide();
        if($(content).length <= 0){
            $('#J_mainContent').append(J_contenthtml);
            content = $('#J_mainContent').find('.J_content.active').addClass(param.content).attr('data-index',index).attr('data-id','#'+url).attr('data-title',param.title);
        }else{
            $(content).addClass('active').attr('data-id','#'+url).attr('data-title',param.title);
        }

        if(param.isExtUrl || param.iframe){
            $(content).show()
        }else{
            $(content).load(url.replace('#','')).show()
        }
    };
    function fixTab(menuTab) {
        var tabMarginLeft = sumWidth($(menuTab).prevAll());
        var tabMarginRight = sumWidth($(menuTab).nextAll());
        var otherWidth = sumWidth($('#J_mainTabs').children().not(".J_menuTabs"));
        var tabZoneWidth = $('#J_mainTabs').outerWidth(true) - otherWidth;
        var px = 0;
        if ($("#J_mainTabs .page-tabs-content").outerWidth() < tabZoneWidth) {
            px = 0
        } else {
            if (tabMarginRight <= (tabZoneWidth - $(menuTab).outerWidth(true) - $(menuTab).next().outerWidth(true))) {
                if ((tabZoneWidth - $(menuTab).next().outerWidth(true)) > tabMarginRight) {
                    px = tabMarginLeft;
                    var tabs = menuTab;
                    while ((px - $(tabs).outerWidth()) > ($("#J_mainTabs .page-tabs-content").outerWidth() - tabZoneWidth)) {
                        px -= $(tabs).prev().outerWidth();
                        tabs = $(tabs).prev()
                    }
                }
            } else {
                if (tabMarginLeft > (tabZoneWidth - $(menuTab).outerWidth(true) - $(menuTab).prev().outerWidth(true))) {
                    px = tabMarginLeft - $(menuTab).prev().outerWidth(true)
                }
            }
        }
        $("#J_mainTabs .page-tabs-content").animate({
            marginLeft : 0 - px + "px"
        }, "fast");


    }
    function moveLeft() {
        var tabMarginLeft = Math.abs(parseInt($("#J_mainTabs .page-tabs-content").css("margin-left")));
        var otherWidth = sumWidth($('#J_mainTabs').children().not(".J_menuTabs"));
        var tabZoneWidth = $('#J_mainTabs').outerWidth(true) - otherWidth;
        var px = 0;
        if ($("#J_mainTabs .page-tabs-content").width() < tabZoneWidth) {
            return false
        } else {
            var tabs = $("#J_mainTabs .J_menuTab:first");
            var menuTabs = 0;
            while ((menuTabs + $(tabs).outerWidth(true)) <= tabMarginLeft) {
                menuTabs += $(tabs).outerWidth(true);
                tabs = $(tabs).next()
            }
            menuTabs = 0;
            if (sumWidth($(tabs).prevAll()) > tabZoneWidth) {
                while ((menuTabs + $(tabs).outerWidth(true)) < (tabZoneWidth) && tabs.length > 0) {
                    menuTabs += $(tabs).outerWidth(true);
                    tabs = $(tabs).prev()
                }
                px = sumWidth($(tabs).prevAll())
            }
        }
        $("#J_mainTabs .page-tabs-content").animate({
            marginLeft : 0 - px + "px"
        }, "fast")
    }
    function moveRight() {
        var tabMarginLeft = Math.abs(parseInt($("#J_mainTabs .page-tabs-content").css("margin-left")));
        var otherWidth = sumWidth($('#J_mainTabs').children().not(".J_menuTabs"));
        var tabZoneWidth = $('#J_mainTabs').outerWidth(true) - otherWidth;
        var px = 0;
        if ($("#J_mainTabs .page-tabs-content").width() < tabZoneWidth) {
            return false
        } else {
            var tabs = $("#J_mainTabs .J_menuTab:first");
            var menuTabs = 0;
            while ((menuTabs + $(tabs).outerWidth(true)) <= tabMarginLeft) {
                menuTabs += $(tabs).outerWidth(true);
                tabs = $(tabs).next()
            }
            menuTabs = 0;
            while ((menuTabs + $(tabs).outerWidth(true)) < (tabZoneWidth) && tabs.length > 0) {
                menuTabs += $(tabs).outerWidth(true);
                tabs = $(tabs).next()
            }
            px = sumWidth($(tabs).prevAll());
            if (px > 0) {
                $("#J_mainTabs .page-tabs-content").animate({
                    marginLeft : 0 - px + "px"
                }, "fast")
            }
        }
    }
    function tabClose() {
        var id = $(this).parents(".J_menuTab").attr("data-id");
        if ($(this).parents(".J_menuTab").hasClass("active")) {
            if ($(this).parents(".J_menuTab").next(".J_menuTab").size()) {
                $(this).parents(".J_menuTab").next(".J_menuTab:eq(0)").addClass('active');
            }else if ($(this).parents(".J_menuTab").prev(".J_menuTab").size()) {
                $(this).parents(".J_menuTab").prev(".J_menuTab:last").addClass('active');
            }
        }
        $(this).parents(".J_menuTab").remove();
        $("#J_mainContent .J_content").each(function () {
            if ($(this).attr("data-id") == id) {
                $(this).remove();
                return false
            }
        });
        window.location.hash = $("#J_mainTabs .J_menuTab.active").attr('data-id');
        return false
    }
    function tabCloseOther() {
        $("#J_mainTabs .page-tabs-content").children("[data-id]").not(":first").not(".active").not(".content-edit").each(function () {
            $('.J_content[data-id="' + $(this).attr("data-id") + '"]').remove();
            $(this).remove()
        });
        $("#J_mainTabs .page-tabs-content").css("margin-left", "0")
    }
    function tabShowActive() {
        fixTab($("#J_mainTabs .J_menuTab.active"))
    }
    function tabEnable() {
        if (!$(this).hasClass("active")) {
            window.location.hash= $(this).attr("data-id");
        }
    }
    function getAbsUrl(url) {
        var a = document.createElement('a');
        a.href=url;
        return a.href;
    };
    function isExtUrl(url){
        var absUrl = getAbsUrl(url);
        var webRoot = window.location.protocol + '//' + window.location.host + '/';
        var urlRoot = absUrl.substr(0, webRoot.length);
        return ( ! (urlRoot===webRoot) );
    };
    function trimLinkText(text){
        var words = text.split(' ');
        var newText = '';
        $.each(words, function(index, value) {
            if($.trim(value))
                newText += ($.trim(value) + ' ');
        });
        return $.trim(newText);
    }

    $(".J_menuItem").on("click", function(){
        var href = $(this).attr('href');
        var url, param;
        url = href.replace('#','');
        param = {
            content: $(this).attr("data-content"),
            title: trimLinkText($(this).text()),
            iframe: $(this).attr("data-iframe"),
            isExtUrl: isExtUrl(href)
        };
        if(param.isExtUrl && !param.iframe) param.content='content-info';
        window.location.hash= decodeURI('#' + url + '?' + $.param(param));
        return false;
    });
    $("#J_mainTabs .J_menuTabs").on("click", ".J_menuTab i", tabClose);
    $("#J_mainTabs .J_tabCloseOther").on("click", tabCloseOther);
    $("#J_mainTabs .J_tabShowActive").on("click", tabShowActive);
    $("#J_mainTabs .J_menuTabs").on("click", ".J_menuTab", tabEnable);
    $("#J_mainTabs .J_tabLeft").on("click", moveLeft);
    $("#J_mainTabs .J_tabRight").on("click", moveRight);
    $("#J_mainTabs .J_tabCloseAll").on("click", function () {
        $("#J_mainTabs .page-tabs-content").children("[data-id]").not(":first").not(".content-edit").each(function () {
            $('.J_content[data-id="' + $(this).attr("data-id") + '"]').remove();
            $(this).remove()
        });
        $("#J_mainTabs .page-tabs-content").children("[data-id]:first").each(function () {
            window.location.hash = $(this).attr('data-id');
        });
    })
});

$("#bbit-tree-node-el").on("click",function(){
    var $(this).ul.style(visibility) = ifVisib;
    if(ifVisib==visibility){
        ifVisib = none;
    }
    if(ifVisib==none){
        ifVisib = visibility;
    }

})
