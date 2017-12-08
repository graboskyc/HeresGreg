/////////////////////////////
// Main functions on load
/////////////////////////////
$(function() {
    $('#video_input').change(function() {
        this.form.submit();
    });
});

(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-74593326-1', 'auto');
ga('send', 'pageview');

/////////////////////////////
// Video handling
/////////////////////////////
var resetDisq = function (newIdentifier, newUrl, newTitle) {
    DISQUS.reset({
        reload: true,
        config: function () {
            this.page.identifier = newIdentifier;
            this.page.url = newUrl;
            this.page.title = newTitle;
        }
    });
};

function setMain(path, e) {
   var fp = "";
   var filter = $(e).data("filter");
   var cva = $(e).data("cvajson");
   var cap = $(e).data("cvacaption");
   console.log(filter);
    $.ajax({
        url:'media/smaller/'+path,
        type:'HEAD',
        error: function()
        {
            //file not exists
            fp = "media/"+path;
            $('#mainvid source').attr('src', fp);
            $("#mainvid").load();
            
            if(filter.length>3) {
                $("#overlayimage").attr("src","overlays/"+filter);
                responsiveVidResize();
                $("#jumbooverlay").css("display","block");
            }
            else {
                $("#overlayimage").attr("src","");
                $("#jumbooverlay").css("display","none");
            }

            $("#jumbomainvidtitle").html(cva + "<br>" + cap);

            $(e).find("center div div").removeClass("newVid");

            ga('send', 'event', 'VideoChange', $('#mainvid source').attr('src'));
        },
        success: function()
        {
            //file exists
            fp = "media/smaller/"+path;
            $('#mainvid source').attr('src', fp);
            $("#mainvid").load();

            resetDisq(path, "http://grabosky.dyndns.org:9999/media/smaller/"+path, "Video " + path);

            if(filter.length>3) {
                $("#overlayimage").attr("src","overlays/"+filter);
                responsiveVidResize();
                $("#jumbooverlay").css("display","block");
            }
            else {
                $("#overlayimage").attr("src","");
                $("#jumbooverlay").css("display","none");
            }

            $("#jumbomainvidtitle").html(cva + "<br>" + cap);

            $(e).find("center div div").removeClass("newVid");

            ga('send', 'event', 'VideoChange', $('#mainvid source').attr('src'));
        }
        
    });

}

function openUpload() {
    $("#video_input").click();
}

function openUploadExisting() {
    $('#video_input').removeAttr("accept");
    $('#video_input').removeAttr("capture");
    $("#video_input").click();
}

function responsiveVidResize() {
    var vidW = $('#mainvid').width();
    var vidH = $('#mainvid').height();
    
    //console.log(vidW + "x" + vidH);
    
    if(vidW == vidH) {
        // not square video
        $('#mainvid').css("height", "100%");
        $('.rr').css("height", "100%");
        $("#jumbooverlay").css("display","block");
        $("#jumbooverlay").css("margin-top","-"+vidH+"px");
        $('#jumbooverlay').css("height", "90%");
        $("#jumbooverlay").css("width",vidW+"px");
        
    }
    else {
        $('#mainvid').css("height", (window.innerHeight*.8)+"px");
        $('.rr').css("height", (window.innerHeight*.8)+"px");
        $("#jumbooverlay").css("display","block");

        var newoverlayheight = ($('#mainvid').height() - 80)*1;
        $("#jumbooverlay").css("margin-top","-"+$('#mainvid').height()+"px");
        //$("#jumbooverlay").css("height",newoverlayheight+"px");
        $("#jumbooverlay").css("width",vidW*1-100+"px");
    }
    
    $('html,body').animate({scrollTop: $('#jumbomainvid').offset().top},'fast');
    
    ga('send', 'event', 'VideoAction', 'Play');

}

function toggleVidPlay() {
    var video = document.getElementById("mainvid");
    if (video.paused) {
        video.play();
    } else {
        video.pause();
    }
}

function getDinner() {
    $.getJSON('/js/food.json', function(data) { 
    var entry = data[Math.floor(Math.random()*data.length)];
    alert("Go to: " + entry["name"]);
    });
}