(function ($) {
  $.fn.tblcolor = function (options) {
    var html_color_picker =
      '<div class="tblcolor-picker">' +
      '<i class="fa fa-font tblcolor-color"></i>' +
      '<i class="fa fa-paint-brush tblcolor-bgcolor"></i>' +
      "</div>";

    return this.each(function () {
      var obj = $(this);

      $(obj)
        .find("td")
        .on("mouseover", function () {
          td = $(this);
          var exist_td_font_color = tblcolor_rgb2hex(td.css("color"));
          var exist_td_bg_color = tblcolor_rgb2hex(td.css("background-color"));

          var html = document.createElement("div");
          html.setAttribute("class", "tblcolor-picker");

          // for color.
          var font_color_picker = document.createElement("input");
          font_color_picker.setAttribute("type", "color");
          font_color_picker.setAttribute("class", "tblcolor-col");
          font_color_picker.setAttribute("value", exist_td_font_color);
          font_color_picker.onchange = function () {
            td.css("color", this.value);
            // Store the selected color in local storage
            var key =
              "cell-" + td.parent().index() + "-" + td.index() + "-color";
            localStorage.setItem(key, this.value);
          };

          var color_label = document.createElement("i");
          color_label.setAttribute("class", "fa fa-font");
          color_label.setAttribute(
            "style",
            "color:#000;position: relative;top: -5px;"
          );
          color_label.innerHTML = ":";

          // for background.
          var font_bg_picker = document.createElement("input");
          font_bg_picker.setAttribute("type", "color");
          font_bg_picker.setAttribute("class", "tblcolor-bg");
          font_bg_picker.setAttribute("value", exist_td_bg_color);
          font_bg_picker.onchange = function () {
            td.css("background-color", this.value);
            // Store the selected color in local storage
            var key =
              "cell-" +
              td.parent().index() +
              "-" +
              td.index() +
              "-background-color";
            localStorage.setItem(key, this.value);
          };

          var color_bg = document.createElement("i");
          color_bg.setAttribute("class", "fa fa-paint-brush");
          color_bg.setAttribute(
            "style",
            "color:#000;position: relative;top: -5px;margin: 0px 5px;"
          );
          color_bg.innerHTML = ":";

          html.appendChild(color_label);
          html.appendChild(font_color_picker);

          html.appendChild(color_bg);
          html.appendChild(font_bg_picker);

          if (td.find(".tblcolor-picker").length <= 0) {
            td.append(html);
          }
        });

      $(obj)
        .find("td")
        .on("mouseleave", function () {
          td = $(this);
          if (td.find(".tblcolor-picker").length > 0)
            td.find(".tblcolor-picker").remove();
        });
        $(obj)
        .find("td")
        .on("mouseenter", function () {
          td = $(this);
          if (td.find(".tblcolor-picker").length > 0)
            td.find(".tblcolor-picker").remove();
        });

      // Restore the saved colors on page load
      $("td", obj).each(function () {
        var td = $(this);
        var rowIndex = td.parent().index();
        var colIndex = td.index();

        // Check if a color has been saved for the background of this cell
        var bgKey = "cell-" + rowIndex + "-" + colIndex + "-background-color";
        var bgColor = localStorage.getItem(bgKey);
        if (bgColor) {
          td.css("background-color", bgColor);
        }

        // Check if a color has been saved for the text of this cell
        var textColorKey = "cell-" + rowIndex + "-" + colIndex + "-color";
        var textColor = localStorage.getItem(textColorKey);
        if (textColor) {
          td.css("color", textColor);
        }
      });
    });
  };
})(jQuery);

function tblcolor_rgb2hex(rgb) {
  rgb = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
  if (rgb != null)
    return (
      "#" + tblcolor_hex(rgb[1]) + tblcolor_hex(rgb[2]) + tblcolor_hex(rgb[3])
    );
}

function tblcolor_hex(x) {
  return ("0" + parseInt(x).toString(16)).slice(-2);
}
