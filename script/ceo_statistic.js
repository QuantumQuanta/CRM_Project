var $k = jQuery.noConflict();

(function ($) {
  $(document).ready(function () {
    var divRespWise = $k('#respWiseDropdown');
    var divClntWise = $k('#clntWiseDropdown');
    data = {
      val: 'go'
    }
    $.ajax({
      url: '../action/ceo_stat_config.php',
      type: 'POST',
      data: data,
      dataType: 'JSON',
      success: function (response) {
        // console.log(response);
        if (response['respwise'] != null) {
          response['respwise'].forEach(function (e) {
            var arrResp = e.split("|");
            var userUNIQId = arrResp[0];
            var userName = arrResp[1];
            var userDesgCode = arrResp[2];
            var userList = $k('<a></a>');
            userList.text(userName + '(' + userDesgCode + ')');
            userList.attr('data-value', userName + "|" + userDesgCode);
            userList.attr('href', '#');
            divRespWise.append(userList);
          });
          response['clientwise'].forEach(function (e) {
            var arrClnt = e.split("|");
            var clUNIQId = arrClnt[0];
            var clName = arrClnt[1];
            var clContact = arrClnt[2];
            var clientList = $k('<a></a>');
            clientList.text(clName + '-' + clContact);
            clientList.attr('data-value', clUNIQId);
            clientList.attr('href', '#');
            divClntWise.append(clientList);
          });
        }
        else {
          console.log('Error in the ajax response!');
        }
      }

    })
  });
})(jQuery);


