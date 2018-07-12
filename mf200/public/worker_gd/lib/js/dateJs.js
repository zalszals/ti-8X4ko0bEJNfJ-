/**
 * 判断是不是闰年
 * @param {*} _year 
 */
function runNian(_year) {
    if(_year%400 === 0 || (_year%4 === 0 && _year%100 !== 0) ) {
        return true;
    }
    else { return false; }
}

/**
 * 判断某年某月的1号是星期几
 * @param {*} _year 
 * @param {*} _month 
 */
function getFirstDay(_year,_month) {
    var allDay = 0, y = _year-1, i = 1;
    allDay = y + Math.floor(y/4) - Math.floor(y/100) + Math.floor(y/400) + 1;
    for ( ; i<_month; i++) {
        switch (i) {
            case 1: allDay += 31; break;
            case 2: 
                if(runNian(_year)) { allDay += 29; }
                else { allDay += 28; }
                break;
            case 3: allDay += 31; break;
            case 4: allDay += 30; break;
            case 5: allDay += 31; break;
            case 6: allDay += 30; break;
            case 7: allDay += 31; break;
            case 8: allDay += 31; break;
            case 9: allDay += 30; break;
            case 10: allDay += 31; break;
            case 11: allDay += 30; break;
            case 12: allDay += 31; break;
        }
    }
    return allDay%7;
}

/**
 * 获取该月有多少天
 * @param {*} _month 
 */
function getMonthDay(_month){
    var monthDay = 31;
    switch (_month) {
        case 1: monthDay = 31; break;
        case 2:
            if (runNian(_year)) { monthDay = 29; }
            else { monthDay = 28; }
            break;
        case 3: monthDay = 31; break;
        case 4: monthDay = 30; break;
        case 5: monthDay = 31; break;
        case 6: monthDay = 30; break;
        case 7: monthDay = 31; break;
        case 8: monthDay = 31; break;
        case 9: monthDay = 30; break;
        case 10: monthDay = 31; break;
        case 11: monthDay = 30; break;
        case 12: monthDay = 31; break;
    }
    return monthDay;
}

/**
 * 显示日历
 * @param {*} _year 
 * @param {*} _month 
 * @param {*} _day  
 */
function getDateNum(_year, _month, _day) {
    var i = 1,
        j = 0,
        c = 0,
        z = 0,
        monthDay = 0,       //当月天数
        lastMonthDay = 0,   //上个月天数
        lastMonth = 1,      //上个月
        nextMonth = 1,      //下一个月
        showStr = "",
        _classname = "",
        today = new Date(),
        reData = new Array;
    var firstDay,tmpJson;  
    var myDate  = new Date();
    _day   = _day   ? _day   : 1;
    _year  = _year  ? _year  : myDate.getFullYear();
    _month = _month ? _month : myDate.getMonth() + 1;
    
    var _year1  = myDate.getFullYear();    //获取完整的年份(4位,1970-????)
    var _month1 = myDate.getMonth() + 1;       //获取当前月份(0-11,0代表1月)
    //验证是否为当月  
    if (_year1 == _year && _month == _month1){
        _day = myDate.getDate();
    }
    //月份的天数
    monthDay = getMonthDay(_month);
    //alert(_day);
    //上个月天数
    lastMonth = _month == 1  ? 12 : _month - 1;
    nextMonth = _month == 12 ? 1  : _month + 1;    
    lastMonthDay = getMonthDay(lastMonth);

    //当月1号是星期几 
    firstDay = getFirstDay(_year, _month);
    
    //填充上月的天数
    z = firstDay ? firstDay : 7;
    for (j = 0; j < z; j++){
        tmpJson = {};
        tmpJson['num'] = lastMonthDay - j;
        tmpJson['is_current'] = 0;
        tmpJson['is_current_month'] = 0;
        reData[j] = tmpJson;       
    }
    reData = reData.reverse();
    //填充本月天数

    for (i = 1; i <= monthDay; i++){
        tmpJson = {};
        tmpJson['num'] = i;
        tmpJson['is_current'] = i == _day ? 1 : 0;
        tmpJson['is_current_month'] = 1;
        reData[j] = tmpJson;        
        j++;
    }
    
    //填充下月天数 
    i = 1;   
    for(j;j<42;j++){
        tmpJson = {};
        tmpJson['num'] = i;
        tmpJson['is_current'] = 0;
        tmpJson['is_current_month'] = 0;
        reData[j] = tmpJson;
        i++;        
    }
    reData[42] = _year;
    reData[43] = _month;
    
    return reData;    
}

/**
 * 显示日历
 * @param {*} tag 
 */
function showCalendar(tag){
    var calendarData,_year,_month;
    switch(tag){
        case 0:
            calendarData = getDateNum();
            break;
        case 1: 
            _month = parseInt($('#current_month').text());
            _year = parseInt($('#current_year').text());
            if (_month==12){
                _year++;
                _month = 1;
            }else{
                _month++;
            }
            calendarData = getDateNum(_year, _month);
            break;
        case -1:
            _month = parseInt($('#current_month').text());
            _year = parseInt($('#current_year').text());
            if (_month == 1) {
                _year--;
                _month = 12;
            } else {
                _month--;
            }
            calendarData = getDateNum(_year, _month);
            break;    
    }
    $('.date_num').each(function (k) {
        $(this).text(calendarData[k].num);
        $(this).removeClass('current_date').removeClass('fc-2');
        if (calendarData[k].is_current){
            $(this).addClass('current_date');
        }
        if (!calendarData[k].is_current_month) {
            $(this).addClass('fc-2');
        }
    })
    $('#current_year').text(calendarData[42]);
    $('#current_month').text(calendarData[43]);
    $('.date_mask').hide();
}

/**
 *  收起日期框
 */
function showqiCalendar(){
    var currentRow_1 = $('.current_date').parent('dl');
    currentRow_2 = currentRow_1.next();
    $('.date_num').parent('dl').hide();
    currentRow_1.show();
    currentRow_2.show(); 
    $('.date-up').hide();
    $('.data-box').height(125);   
}
var myDate = new Date();
var _year = myDate.getFullYear();    //获取完整的年份(4位,1970-????)
var _month = myDate.getMonth() + 1;       //获取当前月份(0-11,0代表1月) 
var _day = myDate.getDate();        //获取当前日(1-31)
var reData = getDateNum();
//console.log(reData);
//showCalendar(0);
setTimeout('showCalendar(0)', 2000);
setTimeout('showqiCalendar()', 2000);
