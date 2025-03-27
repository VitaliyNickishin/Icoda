(function ($) {
  jQuery(document).ready(function () {

    function share__fb(url) {
      window.open(
        "https://www.facebook.com/sharer/sharer.php?u=" +
        encodeURIComponent(url),
        "facebooksharedialog",
        "width=626,height=436"
      );
      addShare();
    }
    function share__twitter(url) {
      var e = $('meta[property="og:title"]').attr("content"),
        n = "http://twitter.com/share?";
      n += "text=" + encodeURIComponent(e);
      n += "&url=" + encodeURIComponent(url);
      n += "&counturl=" + encodeURIComponent(url);
      window.open(n, "", "toolbar=0,status=0,width=626,height=436");
      addShare();
    }
    function share__linkedin(url) {
      window.open(
        "https://www.linkedin.com/sharing/share-offsite/?url=" +
        encodeURIComponent(url),
        "",
        "width=626,height=436"
      );
      addShare();
    }
    function share__telegram(url) {
      var e = $('meta[property="og:title"]').attr("content"),
        n = "https://t.me/share/url?";
      n += "text=" + encodeURIComponent(e);
      n += "&url=" + encodeURIComponent(url);
      window.open(n, "", "toolbar=0,status=0,width=626,height=436");
      addShare();
    }

    function addShare() {
      $.ajax({
        type: "POST",
        url: icoda_share_params.ajaxurl,
        data: {
          action: "share_count",
          id: jQuery("#share_article_id").val(),
        },
        success: function (response) { },
        error: function (error) { },
        complete: function () { },
      });
    }

    document
      .querySelectorAll(".article-share-item")
      .forEach(function (item, i, arr) {
        item.addEventListener("click", function (e) {
          e.preventDefault();
          var socialName = this.dataset.socialname;
          if (socialName != "" && socialName != undefined) {
            var social_sharer = socialName && eval("share__" + socialName);
            var url = $("#share_article_url").val();
            typeof social_sharer == "function" && social_sharer(url);
          }
        });
      });

    $("[data-copy-to-clipboard]").on("click", function () {
      const tmpTarget = document.createElement("textarea");
      tmpTarget.style.position = "absolute";
      tmpTarget.style.left = "-9999px";
      tmpTarget.style.top = "0";
      document.body.appendChild(tmpTarget);
      tmpTarget.textContent = $("#share_article_url").val();
      tmpTarget.select();
      document.execCommand("copy");
      $(tmpTarget).remove();
      textCopiedToClipboard();
    });

    // $('body').on("click", "a.copy-link-to-heading", function (event) {
    //   event.preventDefault();
    //   const tmpTarget = document.createElement("textarea");
    //   tmpTarget.style.position = "absolute";
    //   tmpTarget.style.left = "-9999px";
    //   tmpTarget.style.top = "0";
    //   document.body.appendChild(tmpTarget);
    //   tmpTarget.textContent = $(this).attr('href');
    //   tmpTarget.select();
    //   document.execCommand("copy");
    //   $(tmpTarget).remove();
    //   textCopiedToClipboard();
    // });

    function textCopiedToClipboard() {
      const textCopied = $("[data-text-copied]");
      textCopied.addClass("show");
      setTimeout(function () {
        textCopied.removeClass("show");
      }, 800);
    }

    /* Table of content for single post */
    const $tableOfContent = jQuery(".table-of-content .list-table");
    let $headings = [];
    let addLink = false;
    if( ! $tableOfContent.hasClass('is-overwritten') ) {
      if( jQuery(".new-blog-post-main-content").length ) {
        $headings = jQuery(".new-blog-post-main-content").find(
          "h1:not(.exclude-title-from-table), h2:not(.exclude-title-from-table), h3:not(.exclude-title-from-table), h4:not(.exclude-title-from-table), h5:not(.exclude-title-from-table), h6:not(.exclude-title-from-table)"
        );
        addLink = true;
      } else {
        $headings = jQuery(".article-main-content").find(
          "h1, h2, h3, h4, h5, h6"
        );  
      }
  
      const tmpStack = [{ tag: "H0", children: [] }];
  
      $headings.each(function () {
        const $heading = jQuery(this);
        const text = $heading.text().trim();
        if (text.length) {
          let isStateID = false;
          if( $heading.prop("id") ) {
            isStateID = true;
          }
          const id = $heading.prop("id") ? $heading.prop("id") : get_UID();
          $heading.prop("id", id);
          
          if(addLink && isStateID && $heading.find('.copy-link-to-heading').length == 0) {
            // const toHeadingLink = window.location.origin + window.location.pathname + window.location.search + '#' + id;
            // $heading.append(`<a class="copy-link-to-heading" href="${toHeadingLink}"></a>`);
          }
  
          const tag = $heading.prop("tagName");
          const node = {
            tag,
            text,
            id,
          };
  
          let last = tmpStack.at(-1);
  
          while (last.tag >= node.tag) {
            tmpStack.pop();
            last = tmpStack.at(-1);
          }
  
          last.children = last.children || [];
          last.children.push(node);
          tmpStack.push(node);
        }
      });
      const headingsList = tmpStack[0].children;
  
      let html = "";
      if (headingsList.length) {
        // Level 1
        headingsList.forEach(function (element1) {
          html += `<li> <a href="#${element1.id}">${element1.text}</a>`;
  
          /*
          if (element1.children) {
            html += `<ul class="">`;
            // Level 2
            element1.children.forEach(function (element2) {
              html += `<li> <a href="#${element2.id}">${element2.text}</a>`;
  
              if (element2.children) {
                html += `<ul class="">`;
                // Level 3
                element2.children.forEach(function (element3) {
                  html += `<li> <a href="#${element3.id}">${element3.text}</a>`;
  
                  if (element3.children) {
                    html += `<ul class="">`;
                    // Level 4
                    element3.children.forEach(function (element4) {
                      html += `<li> <a href="#${element4.id}">${element4.text}</a>`;
  
                      if (element4.children) {
                        html += `<ul class="">`;
                        // Level 5
                        element4.children.forEach(function (element5) {
                          html += `<li> <a href="#${element5.id}">${element5.text}</a>`;
  
                          if (element5.children) {
                            html += `<ul class="">`;
                            // Level 6
                            element5.children.forEach(function (element6) {
                              html += `<li> <a href="#${element6.id}">${element6.text}</a>`;
                            });
                            html += `</ul>`;
                          }
                        });
                        html += `</ul>`;
                      }
                    });
                    html += `</ul>`;
                  }
                });
                html += `</ul>`;
              }
            });
  
            html += `</ul>`;
          }
          */
  
          html += `</li>`;
        });
  
        $tableOfContent.append(html);
        $tableOfContent.closest(".table-of-content").show();
      } else {
        $tableOfContent.closest(".table-of-content").remove();
      }
    } else {
      $tableOfContent.closest(".table-of-content").show();
    }


    function get_UID() {
      return String(
        Date.now().toString(32) + Math.random().toString(16)
      ).replace(/\./g, "");
    }
  });
})(jQuery);
