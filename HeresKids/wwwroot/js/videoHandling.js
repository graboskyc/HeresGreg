/////////////////////////////
// Video handling
/////////////////////////////
var errCt = 0;

window.disq_reset = function (newIdentifier, newUrl, newTitle) {
    console.log("Resetting Disqus:",newIdentifier, newUrl, newTitle);
    try {
        DISQUS.reset({
            reload: true,
            config: function () {
                this.page.identifier = newIdentifier;
                this.page.url = newUrl;
                this.page.title = newTitle;
            }
        });
        errCt = 0;
    } catch(e) {
        errCt++;
        console.log("Disqus not ready yet...");
        if(errCt < 6) {
            setTimeout(function() {
                disq_reset(newIdentifier, newUrl, newTitle)
            }, 300);
        }
    }
};

window.disq_create = function(ctr) {
    var dsq = document.createElement('script');
    dsq.type = 'text/javascript';
    dsq.async = true;
    dsq.src = "//greg-grabosky-net.disqus.com/embed.js";
    dsq.disqus_container_id = 'disqus_thread';
    //console.log(ctr);
    //ctr = document.getElementById('disqus_ctr');
    ctr.appendChild(dsq);
}

window.loadVideo = function() {
    setTimeout(function(){ document.getElementById("mainvid").load(); }, 300);
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
}

function toggleVidPlay() {
    var video = document.getElementById("mainvid");
    if (video.paused) {
        video.play();
    } else {
        video.pause();
    }
}

window.captureEnter = function(btnid) {
    document.addEventListener("keyup", function(event) {
        // Number 13 is the "Enter" key on the keyboard
        if (event.keyCode === 13) {
            // Cancel the default action, if needed
            event.preventDefault();
            // Trigger the button element with a click
            document.getElementById(btnid).click();
        }
    });
}