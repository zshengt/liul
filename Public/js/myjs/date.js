
$(function(){
  var date = new Date(); //日期对象
  var year = date.getFullYear(); // 获取年份
  var month = date.getMonth(); // 获取月份-1
  var day = date.getDate(); //获取日期

  //设置当月第一天
  var d1 = new Date(year, month, 1);
  var w1 = d1.getDay();

  //下个月第零天，即这个月有多少天
  var nd1 = new Date(year, month+1, 0);
  var days = nd1.getDate(); //这个月天数
  var html = "";

  for(i=0; i<=6; i++){
    // 6行
    html+= "<tr class='dtr'>";
    for(j=0; j<7; j++){
      idx= i*7+j; // 单元格自然序列号
      d_str = idx-w1+1; //计算日期
      if(d_str>0&&d_str<days+1){
        if(d_str == day){
          html+= "<td class='dtd_now'>"+d_str+"</td>"; 
        }else{
          html+= "<td class='dtd'>"+d_str+"</td>"; 
        }
      }else{
        html+= "<td></td>"
      }
    }
    html+= "</tr>";
  }

  $(".dateTitle").html(year+"年"+month+"月");
  $(".tb").append($(html));
});
