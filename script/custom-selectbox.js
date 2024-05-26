jQuery.fn.extend({
  IconSelectBox: function (img) {
    console.log("img", img);

    if (!this.prop('id')) {
      console.error('Element id not found!');
      return;
    }

    var defaultSelect = '#' + this.prop('id');
    var optionArray = [];
    // convert id to class if id given as selector
    var prefix_class = defaultSelect.replace('#', '.');

    var createElements = function () {
      var btn_select = extractText(defaultSelect);

      var button = document.createElement('button');
      button.classList = btn_select + '-select-box';
      button.type = "button";
      var div = document.createElement('div');
      div.classList = btn_select + '-b';

      var ul = document.createElement('ul');
      ul.classList = btn_select + '-a';

      $(div).append(ul);

      $(button).insertAfter(defaultSelect);

      $(div).insertAfter(button);
    };

    var getStorage = function () {
      var lastSelected = localStorage.getItem(extractText(prefix_class) + '-curr');

      if (lastSelected) {
        //find an item with value of lastSelected

        $(prefix_class + '-select-box').html(lastSelected);
        var val = $(prefix_class + '-select-box').find('[data-value]').data('value');

        $(defaultSelect).val(val);
      } else {
        $(prefix_class + '-select-box').html(optionArray[0]);
        var val = $(optionArray[0]).find('[data-value]').data('value');

        $(defaultSelect).val(val);
      }
    };

    var extractText = function () {
      return defaultSelect.indexOf('#') > -1 ? defaultSelect.replace('#', '') : defaultSelect.replace('.', '');
    };

    var addCss = function () {
      const head = document.querySelector('head');
      const css = prefix_class + '-a {' +
        'padding-left: 0px;' +
        'background: #faf9f9;' +
        'margin-bottom: 0px;' +
        'margin-top: 0px;' +
        '}' +

        prefix_class + '-a img, ' + prefix_class + '-select-box img{' +
        'width: 17px;' +
        '}' +

        prefix_class + '-a li{' +
        'list-style: none;' +
        '/*padding: 10px;*/' +
        'padding: 4px;' +
        'padding-left: 6px;' +
        'text-align: left !important;' +
        'display: flex;' +
        '}' +

        prefix_class + '-a li:not(:last-child){' +
        'border-bottom: 1px solid #dcd6d6;' +
        '}' +

        prefix_class + '-a li:hover{' +
        'background-color: #F4F3F3;' +
        'cursor:pointer' +
        '}' +

        prefix_class + '-a li img {' +
        'margin: 5px;' +
        '}' +

        prefix_class + '-a li span, ' + prefix_class + '-select-box li span {' +
        'margin-left: 2px;' +
        '    margin-top: 3px;' +
        '}' +

        prefix_class + '-b {' +
        'position: absolute;' +
        'display: none;' +
        'width: 46%;' +
        'height:46%;' +
        'overflow: auto;' +
        'top:50%;' +
        'left: 34%;' +
        'box-shadow: 0 6px 12px rgb(0 0 0 / 69%);' +
        'border: 1px solid rgba(0,0,0,.15);' +
        'z-index: 1;' +
        '}' +

        prefix_class + '-select-box {' +
        'display: flex;' +
        'align-items: center;' +
        'padding-left: 8%;' +
        'position: relative;' +
        'width: 82%;' +
        'height: 40px;' +
        'background-color: #dcdef096;' +
        '/*border: 1px solid #e9e8e8;*/' +
        'border: none;' +
        'border-radius: 20px;' +
        'opacity: 0.7;' +
        '}' +

        prefix_class + '-select-box i {' +
        'font-size: 2rem;' +
        'top: 10%;' +
        'position: relative;' +
        '}' +

        prefix_class + '-select-box li i {' +
        'font-size: 1.5rem;' +
        '}' +

        prefix_class + '-select-box li {' +
        'display: flex;' +
        'align-items: center;' +
        'list-style: none;' +
        'float: left;' +
        'padding-bottom: 0px;' +
        'width: 95%;' +
        'text-align: left;' +
        '}' +

        prefix_class + '-select-box li {' +
        'font-size: 16px;' +
        'line-height: 20px;' +
        'font-weight: bold;' +
        'color: #07092c;' +
        'cursor: pointer;' +
        '}' +

        prefix_class + '-select-box:hover li {' +
        'margin-left: 0px;' +
        '}' +

        prefix_class + '-select-box:hover {' +
        'background-color: #F4F3F3;' +
        'border: 1px solid transparent;' +
        'box-shadow: inset 0 0px 0px 1px #ccc;' +
        '}' +

        prefix_class + '-select-box:focus {' +
        'outline:none;' +
        '}' +
        '::-webkit-scrollbar {' +
        'width: 0px;+'
      '}' +
        '::-webkit-scrollbar-track {' +
        'box-shadow: inset 0 0 5px grey; ' +
        'border-radius: 10px;' +
        '}' +
        '::-webkit-scrollbar-thumb {' +
        'background: red; ' +
        'border-radius: 10px;' +
        '}' +
        '::-webkit-scrollbar-thumb:hover {' +
        'background: #b30000; ' +
        ' }';


      $(head).append('<style> ' + css + ' </style>');

    };

    $(defaultSelect).hide();

    $(defaultSelect + ' option').each(function () {
      var text = this.innerText;
      var value = this.value;
      var icon = $(this).data("icon");

      var iconEl = img ? '<img src="' + icon
        + '" alt="icon" data-value="' + value + '"/>'
        : '<i class="' + icon
        + '" data-value="' + value + '"></i>';

      var item = '<li onclick=activity_status("' + value + '","' + text + '")>' + iconEl + ' <span>' + text + '</span></li>';
      optionArray.push(item);
    })

    createElements();
    addCss();

    //console.log(optionArray);
    $(prefix_class + '-a').html(optionArray);

    getStorage();

    //change button stuff on click
    $(prefix_class + '-a li').click(function () {
      var icon = img ? $(this).find('img').attr("src") : $(this).find('i').attr("class");
      var value = img ? $(this).find('img').data('value') : $(this).find('i').data('value');
      var text = this.innerText;

      var iconEl = img ? '<img src="' + icon
        + '" alt="icon" data-value="' + value + '"/>'
        : '<i class="' + icon
        + '" data-value="' + value + '"></i>';

      var item = '<li>' + iconEl + ' <span> ' + text + ' </span>' + '</li>';

      $(prefix_class + '-select-box').html(item);

      $(defaultSelect).val(value);
      $(prefix_class + '-b').toggle();

      localStorage.setItem(extractText(prefix_class) + '-curr', item);
    });

    $(prefix_class + '-select-box').click(function () {
      var cls = $(this).find('[data-arrow]').attr('class');
      // if(cls === "fa fa-angle-up") {
      //     $(this).find('[data-arrow]').attr('class', 'fa fa-angle-down');
      // } else {
      //     $(this).find('[data-arrow]').attr('class', 'fa fa-angle-up');
      // }

      $(prefix_class + '-b').toggle();
    });

  },
  // activity_status:function(val){
  //   console.log("val",val);
  // }

})


// <button class="emp_stat-select-box" type="button"><li><img src="../image/header_selectImg/busy.png" alt="icon" data-value="abhishaw"> <span> Do Not Disturb </span></li></button>
// <div class="emp_stat-b" style="display: block;"><ul class="emp_stat-a"><li onclick="activity_status(&quot;abhishaw&quot;,&quot;" active="" ")=""><img src="../image/header_selectImg/active.png" alt="icon" data-value="abhishaw"> <span>
//                                                         Active
//                                                 </span></li><li onclick="activity_status(&quot;abhishaw&quot;,&quot;" on="" a="" call="" ")=""><img src="../image/header_selectImg/call.png" alt="icon" data-value="abhishaw"> <span>
//                                                         On A Call
//                                                 </span></li><li onclick="activity_status(&quot;abhishaw&quot;,&quot;" updating="" status="" ")=""><img src="../image/header_selectImg/updating.png" alt="icon" data-value="abhishaw"> <span>
//                                                     Updating Status
//                                                 </span></li><li onclick="activity_status(&quot;abhishaw&quot;,&quot;" rest="" ")=""><img src="../image/header_selectImg/rest.png" alt="icon" data-value="abhishaw"> <span>
//                                                     Rest
//                                                 </span></li><li onclick="activity_status(&quot;abhishaw&quot;,&quot;" on="" a="" meeting="" ")=""><img src="../image/header_selectImg/onMeeting.png" alt="icon" data-value="abhishaw"> <span>
//                                                     On A Meeting
//                                                 </span></li><li onclick="activity_status(&quot;abhishaw&quot;,&quot;" do="" not="" disturb="" ")=""><img src="../image/header_selectImg/busy.png" alt="icon" data-value="abhishaw"> <span>
//                                                     Do Not Disturb
//                                                 </span></li></ul></div>