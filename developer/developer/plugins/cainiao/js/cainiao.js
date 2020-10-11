var webSocket;
var socket;
var printData;
var printer_address = '127.0.0.1:13528';
//var printer_address = '127.0.0.1:13529';
var re =  /^([0-9]|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.([0-9]|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.([0-9]|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.([0-9]|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]):[\d]+$/;
	//备注：webSocket 是全局对象，不要每次发送请求丢去创建一个，做到webSocket对象重用，和打印组件保持长连接。
	jQuery(function() {
	    var defaultMessage ={ "cmd": "print","requestID": "123458976","version": "1.0","task": {"taskID": "1","preview": false,"printer": "QR-588-1","documents":[{"documentID": "9890000106027","contents": [{"data": {"recipient": {"address": {"city": "北京市","detail": "花家地社区卫生服务站三层楼我也不知道是哪儿了","district": "朝阳区","province": "北京","town": "望京街道"},"mobile": "1326443654","name": "张三","phone": "057123222"},"routingInfo": {"consolidation": {"name": "杭州","code": "hangzhou"},"origin": {"code":"POSTB"},"sortation":{"name": "杭州"},"routeCode": "380D-56-04"},"sender": {"address": {"city": "北京市","detail": "花家地社区卫生服务站二层楼我也不知道是哪儿了","district": "朝阳区","province": "北京","town": "望京街道"},"mobile": "1326443654","name": "张三","phone": "057123222"},"shippingOption":{"code":"COD","services": {"SVC-COD": {"value": "200"}},"title": "代收货款"},"waybillCode": "9890000160004"},"signature":"123","templateURL": "http://cloudprint.cainiao.com/template/standard/83910/7"}]}]}};
	    printData = defaultMessage;
	});
	//菜鸟组件下载弹出层
	function install_print(){
		urls = $("#hidden_url").val();
		layer.open({
	        type: 1,
	        title: '<b>菜鸟打印组件下载</b>',
	        skin: 'layui-layer-rim', //加上边框
	        area: ['520px', 'auto'], //宽高
	        content: '<div class="pt-10 pb-10 pl-30 pr-30 "><form action="" id="form3" method="POST" enctype=multipart/form-data>' +
	        '<div id="" style="width:100%;text-align:center;font-size:14px;color:#FF00FF;" class="">菜鸟打印组件尚未安装启动!点击下载并安装,安装后请刷新页面。</div>'+
	        '<div style="width: 100%;text-align:center;color:#0096ff"><ul><li><a href="'+urls+'" target="_blank">点击下载</a></li>' +
	        '</ul></div>'+
	        '</form></div>',
	   });
	} 
 	//连接打印机，执行socket相关操作
	function doConnect(width,height)
	{  
		socket = new WebSocket('ws://'+printer_address);//建立连接，loscalhost是ip地址，本机可以使用localhost或者127.0.0.1。13528是ws的端口号，固定检测这个端口
		//如果是https的话，端口是13529
		//socket = new WebSocket('wss://'+printer_address);
	    if(!re.test(printer_address) && printer_address != 'localhost') {
	       alert("ip地址格式不正确，请修改:ip:port");
	       return false;
	    } 
	    // 打开Socket
		/*if(socket.readyState == 0) {
		     alert('WebSocket连接中...');
		}*/ 
		// 打开Socket
	    socket.onopen = function(event)
	    {
	    	console.log("Websocket准备就绪,连接到客户端成功");
	        //监听消息  响应请求
	        socket.onmessage = function(event)
	        { 
	        	console.log('Client received a message',event);
	        	var obj=event.data; 
	        	var arr=JSON.parse(obj);//将jeson字符串转化为数组 
	        	defaultPrinter=arr["defaultPrinter"];//当前计算机默认打印机 
	           	
	            var data = JSON.parse(event.data);
	            var page='';//如果是预览则存在值
	            if(data.previewImage){
	            	page=data.previewImage;
	            }else{
	            	page=null;
	            } 
	            if(data.cmd == "getPrinters"){//如果当前请求的是getPrinters，则获取打印及列表
	            	if($("#labelprinte")){
	            		$(data.printers).each(function(k,v){
	                		$("#labelprinte").append('<option value="'+v.name+'">'+v.name+'</option>');
	                	})
	            	}
	            }else if(data.cmd == "print" && data.status == "success" && page !=null ){//预览返回的数据（成功） 
	            	var objWin;
		            //目标页面     
		           // var target='yulan?page='+page;
		            /*console.log(page);
		           	var result=page.split("/");
						for(var i=0;i<result.length;i++){
					 		document.write(result[i]);
						}
		           */ 
		            var target='yulan?size='+width+'*'+height+'&page='+page;
//		            var target='yulan?&page='+page;
		            //var target = "pop.html?id="+1; 
		            //console.log(objWin);
					//var target = "yulan?page=http://localhost:13530/20180514_175324_813_15531.jpg"; 
		            //判断预览页面是否已经打开，打开则刷新，否则新开页面 
		            if (objWin == null || objWin.closed) {  
		                objWin = window.open(target);  
		            } else { 
		                objWin.location.replace(target); 
		            }  
	            }else if(data.cmd == "print" && data.status != "success" && page !=null ){//预览失败
	            	var msg=data.msg;
	            	alert("预览失败:"+msg);
	            }else if(data.cmd == "notifyPrintResult"){//打印通知，返回的数据  
	            	//var reson =data.printStatus;//这是一个数组 
	            	//$.each(reson,function(k,v){
	            		//alert(v.msg);
	            	//}) 
	            	if(data.taskStatus == "failed"){//打印失败
	            		alert("打印失败，请检查菜鸟组件是否成功连接电脑");
	            	}else if(data.taskStatus == "rendered"){//渲染成功
	            		alert("渲染完成，请等待出纸，若未出纸，请检查打印机是否连接或开启");
	            	}else if(data.taskStatus == "printed"){//出纸成功
	            		alert("出纸成功");
	            	} 
	            }else{
	                console.log("返回数据:" + JSON.stringify(data));
	            }
	        }; 
	        // 监听Socket的关闭
	        socket.onclose = function(event)
	        {
	            console.log('Client notified socket has closed',event);
	        };
	    }; 
	    socket.onerror = function(event) {
	    	alert('无法连接到:' + printer_address+' \n如果你还没有安装菜鸟打印组件,请下载并安装;\n如果你已经安装，请启动菜鸟打印组件！');
	    	install_print();
		};
	}

	/***  
	 * 获取请求的UUID，指定长度和进制,如 
	 * getUUID(8, 2)   //"01001010" 8 character (base=2)
	 * getUUID(8, 10) // "47473046" 8 character ID (base=10)
	 * getUUID(8, 16) // "098F4D35"。 8 character ID (base=16)
	 ***/
	function getUUID(len, radix) {
	    var chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'.split('');
	    var uuid = [], i;
	    radix = radix || chars.length; 
	    if (len) {
	      for (i = 0; i < len; i++) uuid[i] = chars[0 | Math.random()*radix];
	    } else {
	      var r;
	      uuid[8] = uuid[13] = uuid[18] = uuid[23] = '-';
	      uuid[14] = '4';
	      for (i = 0; i < 36; i++) {
	        if (!uuid[i]) {
	          r = 0 | Math.random()*16;
	          uuid[i] = chars[(i == 19) ? (r & 0x3) | 0x8 : r];
	        }
	      }
	    }
	    return uuid.join('');
	}

	/***
	 * 构造request对象
	 */
	function getRequestObject(cmd) {
	    var request  = new Object();
	    request.requestID=getUUID(8, 16);
	    request.version="1.0";
	    request.cmd=cmd;
	    return request;
	}

	/***
	 * 请求打印机列表协议(请求打印机列表demo)
	 */
	function getPrinters() {
		var request  = getRequestObject("getPrinters");
	    socket.send(JSON.stringify(request));
	}

	/***
	 * 请求打印机配置协议
	 */
	function getPrinterConfig() {
		var request  = getRequestObject("getPrinterConfig");
	    request.printer="QR-800 LABEL";
	    socket.send(JSON.stringify(request));
	}

	/***
	 * 获取打印机配置(弹出打印机配置界面)协议
	 */
	function printerConfig() {
		var request  = getRequestObject("printerConfig");
	    request.printer="QR-800 LABEL";
	    socket.send(JSON.stringify(request));
	}

	/***
	 * 设置打印机
	 ***/
	function setPrinterConfig() {
		var request  = getRequestObject("setPrinterConfig");
		request.printer = {
	        name : "QR-800 LABEL",
	        needTopLogo : false,
	        needBottomLogo: false,
	        horizontalOffset : 0.1,
	        verticalOffset : 0.1,
	        forceNoPageMargins : true,
	        paperSize :{"width":100, "height":180}
	    };
	    socket.send(JSON.stringify(request));
	}

	/***
	 * 获取全局配置信息(getGlobalConfig)
	 ***/
	function getGlobalConfig(){
		var request  = getRequestObject("getGlobalConfig");
		socket.send(JSON.stringify(request));
	}

	/***
	 * 发送打印/预览数据协议(print)
	 * @param preview 如果为true，则是预览模式，为false，则直接打印，默认直接打印
	 * @param printer 当前使用的打印机
	 * @param data 打印或预览的数据
	 * @param custom_Data 自定义打印或预览数据
	 * @param waybill_type 面单类型
	 * @param customUrl 自定义数据的url
	 * task请求上面是标准面单数据和模板url，下面是商家自定义区数据和url
	 ***/
	function doPrint(printer,preview,data,custom_Data,waybill_type,customUrl){ 
		var request  = getRequestObject("print");   
		var printData = '[';
		if(waybill_type==1){//普通面单 
			data.waybill_code = 98099336549699; //预览时，随便传值，但打印必须传模板的code   
			$.each(custom_Data, function(k,v) {      
		        printData += '{'+
		            'documentID : "'+data.waybill_code+'",'+
		            'contents : ['+  
		            	 '{'+  
		                    'templateURL : "'+customUrl+'",'+//生成的文件夹
		                    'data : {'+
		                    	  '"waybill_sender_name": "'+v.waybill_sender_name+'",'+  //寄件人
		                    	  '"waybill_sender_postcode": "'+v.waybill_sender_postcode+'",'+  //寄件人邮编 
		                    	  '"waybill_sender_province": "'+v.waybill_sender_province+'",'+ //寄件人省
		                    	  '"waybill_sender_city": "'+v.waybill_sender_city+'",'+  //寄件人市
		                    	  '"waybill_sender_district": "'+v.waybill_sender_district+'",'+  //寄件人区
		                    	  '"waybill_sender_town": "'+v.waybill_sender_town+'",'+  //寄件人街道
		                    	  '"waybill_sender_detail": "'+v.waybill_sender_detail+'",'+  //寄件人完整街道
		                    	  '"waybill_sender_phone": "'+v.waybill_sender_phone+'",'+  //寄件人打电话
		                    	  '"waybill_sender_mobile": "'+v.waybill_sender_mobile+'",'+  //寄件人手机
		                    	  
		                    	  '"waybill_sender_tel": "'+v.waybill_sender_tel+'",'+  //寄件人手机/电话
		                    	  '"waybill_sender_company": "'+v.waybill_sender_company+'",'+  //寄件人公司
		                    	  '"waybill_sender_num1": "'+v.waybill_sender_num1+'",'+  //寄件人自定义1
		                    	  '"waybill_sender_num2": "'+v.waybill_sender_num2+'",'+  //寄件人自定义2
		                    	  '"waybill_sender_num3": "'+v.waybill_sender_num3+'",'+  //寄件人自定义3
		                    	  '"waybill_sender_id": "'+v.waybill_sender_id+'",'+  //寄件人id
		                    	  '"waybill_sender_note": "'+v.waybill_sender_note+'",'+  //卖家备注
		                    	  '"waybill_store_name": "'+v.waybill_store_name+'",'+  //店铺名称
		                    	  '"waybill_recipient_note": "'+v.waybill_recipient_note+'",'+  //买家留言 
		                    	  
		                    	  '"waybill_recipient_name": "'+v.waybill_recipient_name+'",'+  //收件人
		                    	  '"waybill_recipient_id": "'+v.waybill_recipient_id+'",'+  //收件人id
		                    	  '"waybill_recipient_postcode": "'+v.waybill_recipient_postcode+'",'+  //收件人邮编
		                    	  '"waybill_recipient_province": "'+v.waybill_recipient_province+'",'+  //收件人省
		                    	  '"waybill_recipient_city": "'+v.waybill_recipient_city+'",'+  //收件人市
		                    	  '"waybill_recipient_district": "'+v.waybill_recipient_district+'",'+  //收件人区
		                    	  '"waybill_recipient_town": "'+v.waybill_recipient_town+'",'+  //收件人街道
		                    	  '"waybill_recipient_detail": "'+v.waybill_recipient_detail+'",'+  //收件人完整地址 
		                    	  '"waybill_recipient_phone": "'+v.waybill_recipient_phone+'",'+  //收件人电话
	                    	      '"waybill_recipient_mobile": "'+v.waybill_recipient_mobile+'",'+  //收件人手机
		                    	  '"waybill_recipient_tel": "'+v.waybill_recipient_tel+'",'+  //收件人手机/电话
		                    	  
		                    	  '"waybill_goods_count": "'+v.waybill_goods_count+'",'+  //商品数量合计
		                    	  '"waybill_goods_weight": "'+v.waybill_goods_weight+'",'+  //商品重量合计
		                    	  '"waybill_invoice_title": "'+v.waybill_invoice_title+'",'+  //发票抬头
		                    	  '"waybill_sender_station": "'+v.waybill_sender_station+'",'+  //始发站点
	                    	      '"waybill_sender_station_code": "'+v.waybill_sender_station_code+'",'+  //始发编号
		                    	  '"waybill_sender_station_code128": "'+v.waybill_sender_station_code128+'",'+  //始发编号128A
		                    	  '"waybill_recipient_station": "'+v.waybill_recipient_station+'",'+  //目的站点
		                    	  '"waybill_recipient_station_code": "'+v.waybill_recipient_station_code+'",'+  //末端分拣号
		                    	  '"waybill_recipient_station_code128": "'+v.waybill_recipient_station_code128+'",'+  //末端分拣号128
								  '"waybill_routingInfo": "'+v.waybill_routingInfo+'",'+  //大头笔
								  '"waybill_routingInfo_area": "'+v.waybill_routingInfo_area+'",'+  //集包地
								  '"waybill_routingInfo_area_code": "'+v.waybill_routingInfo_area_code+'",'+  //集包代码
								  '"waybill_routingInfo_area_code4": "'+v.waybill_routingInfo_area_code4+'",'+  //安能四段码
								  '"waybill_routingInfo_code": "'+v.waybill_routingInfo_code+'",'+  //包裹编码
								  '"waybill_goods_images": "'+v.waybill_goods_images+'",'+  //二维码或图片
								  '"waybill_goods_img": "'+v.waybill_goods_img+'",'+  //图片
								  '"waybill_goods_money": "'+v.waybill_goods_money+'",'+  //金额合计
								  '"waybill_goods_money_w": "'+v.waybill_goods_money_w+'",'+  //金额大写
								  '"waybill_recipient_province_j": "'+v.waybill_recipient_province_j+'",'+  //收件人简省
								  '"waybill_ordersn": "'+v.waybill_ordersn+'",'+  //订单编号
								  '"waybill_print_data": "'+v.waybill_print_data+'",'+  //打印日期
								  '"waybill_print_time": "'+v.waybill_print_time+'",'+  //打印时间
								  '"waybill_pay_type": "'+v.waybill_pay_type+'",'+  //付款方式
								  '"waybill_pay_time": "'+v.waybill_pay_time+'",'+  //付款时间
								  '"waybill_invoice_w": "'+v.waybill_invoice_w+'",'+  //横线  
		                    	  '"waybill_invoice_h": "'+v.waybill_invoice_h+'"'+ //竖线
		                    '}'+
		                '}'+
		            ']'+
		        '},';
			}); 
		}else{ //热敏三联或者两联 
			$.each(data, function(k,v) { 
				waybill_code='';
				if(preview){//预览面单号固定
					waybill_code=98099336549699;
				}else{
					waybill_code=v.waybill_code;//面单号
				} 
				//判断接口返回的发件人收件人镇是否存在 存在则复制
				var recipient_town='';
				if(v.print_data.data.recipient.address.town){
					recipient_town=v.print_data.data.recipient.address.town;
				}
				var sender_town='';
				if(v.print_data.data.sender.address.town){
					sender_town=v.print_data.data.sender.address.town;
				}
				
				var goods = '';
				var i = 1;
				$.each(v.print_data.data.item,function(k2,v2) {
					goods += "商品"+i+":"+v2.title+" 属性:"+v2.sku_properties_na+" 数量:"+v2.buy_num+"\n";//数据库获取当前商品信息
					i++;
				})  
				goods = goods.substr(0, goods.length - 2);//商品信息，从开始截取到倒数第二位，（截取最后一个商品信息，因为此处商品信息不需要换行） 
				//自定义内容
				custData ='';
				$.each(custom_Data, function(key,value) { 
					custData='"waybill_sender_name": "'+value.waybill_sender_name+'",'+  //寄件人
	                    	  '"waybill_sender_postcode": "'+value.waybill_sender_postcode+'",'+  //寄件人邮编 
	                    	  '"waybill_sender_province": "'+value.waybill_sender_province+'",'+ //寄件人省
	                    	  '"waybill_sender_city": "'+value.waybill_sender_city+'",'+  //寄件人市
	                    	  '"waybill_sender_district": "'+value.waybill_sender_district+'",'+  //寄件人区
	                    	  '"waybill_sender_town": "'+value.waybill_sender_town+'",'+  //寄件人街道
	                    	  '"waybill_sender_detail": "'+value.waybill_sender_detail+'",'+  //寄件人完整街道
	                    	  '"waybill_sender_phone": "'+value.waybill_sender_phone+'",'+  //寄件人打电话
	                    	  '"waybill_sender_mobile": "'+value.waybill_sender_mobile+'",'+  //寄件人手机
	                    	  
	                    	  '"waybill_sender_tel": "'+value.waybill_sender_tel+'",'+  //寄件人手机/电话
	                    	  '"waybill_sender_company": "'+value.waybill_sender_company+'",'+  //寄件人公司
	                    	  '"waybill_sender_num1": "'+value.waybill_sender_num1+'",'+  //寄件人自定义1
	                    	  '"waybill_sender_num2": "'+value.waybill_sender_num2+'",'+  //寄件人自定义2
	                    	  '"waybill_sender_num3": "'+value.waybill_sender_num3+'",'+  //寄件人自定义3
	                    	  '"waybill_sender_id": "'+value.waybill_sender_id+'",'+  //寄件人id
	                    	  '"waybill_sender_note": "'+value.waybill_sender_note+'",'+  //卖家备注
	                    	  '"waybill_store_name": "'+value.waybill_store_name+'",'+  //店铺名称
	                    	  '"waybill_recipient_note": "'+value.waybill_recipient_note+'",'+  //买家留言 
	                    	  
	                    	  '"waybill_recipient_name": "'+value.waybill_recipient_name+'",'+  //收件人
	                    	  '"waybill_recipient_id": "'+value.waybill_recipient_id+'",'+  //收件人id
	                    	  '"waybill_recipient_postcode": "'+value.waybill_recipient_postcode+'",'+  //收件人邮编
	                    	  '"waybill_recipient_province": "'+value.waybill_recipient_province+'",'+  //收件人省
	                    	  '"waybill_recipient_city": "'+value.waybill_recipient_city+'",'+  //收件人市
	                    	  '"waybill_recipient_district": "'+value.waybill_recipient_district+'",'+  //收件人区
	                    	  '"waybill_recipient_town": "'+value.waybill_recipient_town+'",'+  //收件人街道
	                    	  '"waybill_recipient_detail": "'+value.waybill_recipient_detail+'",'+  //收件人完整地址 
	                    	  '"waybill_recipient_phone": "'+value.waybill_recipient_phone+'",'+  //收件人电话
                    	      '"waybill_recipient_mobile": "'+value.waybill_recipient_mobile+'",'+  //收件人手机
	                    	  '"waybill_recipient_tel": "'+value.waybill_recipient_tel+'",'+  //收件人手机/电话
	                    	  
	                    	  '"waybill_goods_count": "'+value.waybill_goods_count+'",'+  //商品数量合计
	                    	  '"waybill_goods_weight": "'+value.waybill_goods_weight+'",'+  //商品重量合计
	                    	  '"waybill_invoice_title": "'+value.waybill_invoice_title+'",'+  //发票抬头
	                    	  '"waybill_sender_station": "'+value.waybill_sender_station+'",'+  //始发站点
                    	      '"waybill_sender_station_code": "'+value.waybill_sender_station_code+'",'+  //始发编号
	                    	  '"waybill_sender_station_code128": "'+value.waybill_sender_station_code128+'",'+  //始发编号128A
	                    	  '"waybill_recipient_station": "'+value.waybill_recipient_station+'",'+  //目的站点
	                    	  '"waybill_recipient_station_code": "'+value.waybill_recipient_station_code+'",'+  //末端分拣号
	                    	  '"waybill_recipient_station_code128": "'+value.waybill_recipient_station_code128+'",'+  //末端分拣号128
							  '"waybill_routingInfo": "'+value.waybill_routingInfo+'",'+  //大头笔
							  '"waybill_routingInfo_area": "'+value.waybill_routingInfo_area+'",'+  //集包地
							  '"waybill_routingInfo_area_code": "'+value.waybill_routingInfo_area_code+'",'+  //集包代码
							  '"waybill_routingInfo_area_code4": "'+value.waybill_routingInfo_area_code4+'",'+  //安能四段码
							  '"waybill_routingInfo_code": "'+value.waybill_routingInfo_code+'",'+  //包裹编码
							  '"waybill_goods_images": "'+value.waybill_goods_images+'",'+  //二维码或图片
							  '"waybill_goods_img": "'+value.waybill_goods_img+'",'+  //图片
							  '"waybill_goods_money": "'+value.waybill_goods_money+'",'+  //金额合计
							  '"waybill_goods_money_w": "'+value.waybill_goods_money_w+'",'+  //金额大写
							  '"waybill_recipient_province_j": "'+value.waybill_recipient_province_j+'",'+  //收件人简省
							  '"waybill_ordersn": "'+value.waybill_ordersn+'",'+  //订单编号
							  '"waybill_print_data": "'+value.waybill_print_data+'",'+  //打印日期
							  '"waybill_print_time": "'+value.waybill_print_time+'",'+  //打印时间
							  '"waybill_pay_type": "'+value.waybill_pay_type+'",'+  //付款方式
							  '"waybill_pay_time": "'+value.waybill_pay_time+'",'+  //付款时间
							  '"waybill_invoice_w": "'+value.waybill_invoice_w+'",'+  //横线  
	                    	  '"waybill_invoice_h": "'+value.waybill_invoice_h+'"'; //竖线
				});
				 
				//打印或预览数据
		        printData += '{'+
		            'documentID : "'+waybill_code+'",'+
		            'contents : ['+  
		                '{'+
		                //'templateURL : "http://cloudprint.cainiao.com/template/standard/75704",'+
		                	'templateURL :"'+v.print_data.templateURL+'",'+
		                    '"data": {'+
		                      '"recipient": {'+ 
		                        '"address": {'+
		                          '"city": "'+v.print_data.data.recipient.address.city+'",'+
		                          '"detail": "'+v.print_data.data.recipient.address.detail+'",'+
		                          '"district": "'+v.print_data.data.recipient.address.district+'",'+
		                          '"province": "'+v.print_data.data.recipient.address.province+'",'+
		                          '"town": "'+recipient_town+'"'+
		                        '},'+
		                        '"mobile": "'+v.print_data.data.recipient.mobile+'",'+
		                        '"name": "'+v.print_data.data.recipient.name+'",'+
		                        '"phone": "'+v.print_data.data.recipient.phone+'"'+ 
		                      '},'+
		                      '"routingInfo": {'+
		                        '"consolidation": {'+
		                          '"name": "'+v.print_data.data.routingInfo.consolidation.name+'",'+
		                          '"code": ""'+
		                        '},'+
		                        '"origin": {'+
		                          '"code": "'+v.print_data.data.routingInfo.origin.code+'",'+
		                        '},'+
		                        '"sortation": {'+
		                          '"name": "'+v.print_data.data.routingInfo.sortation.name+'",'+
		                        '},'+
		                        '"routeCode": "'+v.print_data.data.routingInfo.routeCode+'",'+
		                      '},'+
		                      '"sender": {'+
		                        '"address": {'+
		                          '"city": "'+v.print_data.data.sender.address.city+'",'+
		                          '"detail": "'+v.print_data.data.sender.address.detail+'",'+
		                          '"district": "'+v.print_data.data.sender.address.district+'",'+
		                          '"province": "'+v.print_data.data.sender.address.province+'",'+
		                          '"town": "'+sender_town+'"'+
		                        '},'+
		                        '"mobile": "'+v.print_data.data.sender.mobile+'",'+
		                        '"name": "'+v.print_data.data.sender.name+'",'+
		                        '"phone": "'+v.print_data.data.sender.phone+'",'+
		                      '},'+
		                      '"shippingOption": {'+
		                        '"code": "'+v.print_data.data.shippingOption.code+'",'+
		                        '"title": "'+v.print_data.data.shippingOption.title+'",'+
		                      '},'+
		                      '"waybillCode": "'+waybill_code+'",'+ 
		                    '}'+
		                '},'+
		                '{'+  
		                
		                 //'templateURL : "http://cloudprint.cainiao.com/template/standard/242825",'+//生成的文件夹
		                    'templateURL : "'+customUrl+'",'+//自定义模板生成的文件夹 
		                    'data : {'+custData+'}'+
		                '}'+
		            ']'+
		        '},';
		       }); 
		}
		printData += ']';//documtents中的有半括号 
		printData=eval('(' + printData + ')');//printData是字符串，使用eval("("+printData+")")可以将其转换为json对象，和JSON.parse的功能一样。  
		request.task = { 
		    taskID: getUUID(8,10),
	        preview: preview,  //如果为true，则是预览模式，为false，则直接打印
	        previewType:"image",//如果是预览模式，是以pdf还是image方式预览，二选一，此属性不是必选，默认以pdf预览。
	        printer: printer,
	        notifyMode:"allInOne",//打印结果通知模式，是逐个document通知还是批量一次通知最终打印结果
	        firstDocumentNumber:data.waybill_code,// v0.2.8.3 新增：task 起始 document 序号
	        totalDocumentCount:1,// v0.2.8.3 本次新增task document 总数
            documents : printData
		} 
	    socket.send(JSON.stringify(request));
	}
	
    //task，请求上面是标准面单数据和模板url，下面是商家自定义区数据和url
    /**
     * 打印端预览方法
     * */
	function doPrview(printer,preview,data,custom_Data,waybill_type,customUrl){ 
		var request  = getRequestObject("print");  
		data.waybill_code = 98099336549699; //预览时，随便传值，但打印必须传模板的code   
		var printData = '[';
		if(waybill_type==1){//普通面单预览  
//			$.each(custom_Data, function(k,v) {  
//				var goods = '';
//				var i = 1;
//				$.each(v.print_data.data.item,function(k2,v2) {
//					goods += "商品"+i+":"+v2.title+" 属性:"+v2.sku_properties_na+" 数量:"+v2.buy_num+"\n";//数据库获取当前商品信息
//					i++;
//				})  
//				goods = goods.substr(0, goods.length - 2);//商品信息，从开始截取到倒数第二位，（截取最后一个商品信息，因为此处商品信息不需要换行）    
		        printData += '{'+
		            'documentID : "'+data.waybill_code+'",'+
		            'contents : ['+  
		            	 '{'+ 
		                    //'templateURL : "http://127.0.0.1/dpb/data/cntpl/putong.txt",'+//生成的文件夹
		                    'templateURL : "'+customUrl+'",'+//生成的文件夹
		                    'data : {'+
		                    	   '"waybill_sender_name": "'+custom_Data.waybill_sender_name+'",'+  //寄件人
		                    	  '"waybill_sender_postcode": "'+custom_Data.waybill_sender_postcode+'",'+  //寄件人邮编 
		                    	  '"waybill_sender_province": "'+custom_Data.waybill_sender_province+'",'+ //寄件人省
		                    	  '"waybill_sender_city": "'+custom_Data.waybill_sender_city+'",'+  //寄件人市
		                    	  '"waybill_sender_district": "'+custom_Data.waybill_sender_district+'",'+  //寄件人区
		                    	  '"waybill_sender_town": "'+custom_Data.waybill_sender_town+'",'+  //寄件人街道
		                    	  '"waybill_sender_detail": "'+custom_Data.waybill_sender_detail+'",'+  //寄件人完整街道
		                    	  '"waybill_sender_phone": "'+custom_Data.waybill_sender_phone+'",'+  //寄件人打电话
		                    	  '"waybill_sender_mobile": "'+custom_Data.waybill_sender_mobile+'",'+  //寄件人手机
		                    	  
		                    	  '"waybill_sender_tel": "'+custom_Data.waybill_sender_tel+'",'+  //寄件人手机/电话
		                    	  '"waybill_sender_company": "'+custom_Data.waybill_sender_company+'",'+  //寄件人公司
		                    	  '"waybill_sender_num1": "'+custom_Data.waybill_sender_num1+'",'+  //寄件人自定义1
		                    	  '"waybill_sender_num2": "'+custom_Data.waybill_sender_num2+'",'+  //寄件人自定义2
		                    	  '"waybill_sender_num3": "'+custom_Data.waybill_sender_num3+'",'+  //寄件人自定义3
		                    	  '"waybill_sender_id": "'+custom_Data.waybill_sender_id+'",'+  //寄件人id
		                    	  '"waybill_sender_note": "'+custom_Data.waybill_sender_note+'",'+  //卖家备注
		                    	  '"waybill_store_name": "'+custom_Data.waybill_store_name+'",'+  //店铺名称
		                    	  '"waybill_recipient_note": "'+custom_Data.waybill_recipient_note+'",'+  //买家留言 
		                    	  
		                    	  '"waybill_recipient_name": "'+custom_Data.waybill_recipient_name+'",'+  //收件人
		                    	  '"waybill_recipient_id": "'+custom_Data.waybill_recipient_id+'",'+  //收件人id
		                    	  '"waybill_recipient_postcode": "'+custom_Data.waybill_recipient_postcode+'",'+  //收件人邮编
		                    	  '"waybill_recipient_province": "'+custom_Data.waybill_recipient_province+'",'+  //收件人省
		                    	  '"waybill_recipient_city": "'+custom_Data.waybill_recipient_city+'",'+  //收件人市
		                    	  '"waybill_recipient_district": "'+custom_Data.waybill_recipient_district+'",'+  //收件人区
		                    	  '"waybill_recipient_town": "'+custom_Data.waybill_recipient_town+'",'+  //收件人街道
		                    	  '"waybill_recipient_detail": "'+custom_Data.waybill_recipient_detail+'",'+  //收件人完整地址 
		                    	  '"waybill_recipient_phone": "'+custom_Data.waybill_recipient_phone+'",'+  //收件人电话
	                    	      '"waybill_recipient_mobile": "'+custom_Data.waybill_recipient_mobile+'",'+  //收件人手机
		                    	  '"waybill_recipient_tel": "'+custom_Data.waybill_recipient_tel+'",'+  //收件人手机/电话
		                    	  
		                    	  '"waybill_goods_count": "'+custom_Data.waybill_goods_count+'",'+  //商品数量合计
		                    	  '"waybill_goods_weight": "'+custom_Data.waybill_goods_weight+'",'+  //商品重量合计
		                    	  '"waybill_invoice_title": "'+custom_Data.waybill_invoice_title+'",'+  //发票抬头
		                    	  '"waybill_sender_station": "'+custom_Data.waybill_sender_station+'",'+  //始发站点
	                    	      '"waybill_sender_station_code": "'+custom_Data.waybill_sender_station_code+'",'+  //始发编号
		                    	  '"waybill_sender_station_code128": "'+custom_Data.waybill_sender_station_code128+'",'+  //始发编号128A
		                    	  '"waybill_recipient_station": "'+custom_Data.waybill_recipient_station+'",'+  //目的站点
		                    	  '"waybill_recipient_station_code": "'+custom_Data.waybill_recipient_station_code+'",'+  //末端分拣号
		                    	  '"waybill_recipient_station_code128": "'+custom_Data.waybill_recipient_station_code128+'",'+  //末端分拣号128
								  '"waybill_routingInfo": "'+custom_Data.waybill_routingInfo+'",'+  //大头笔
								  '"waybill_routingInfo_area": "'+custom_Data.waybill_routingInfo_area+'",'+  //集包地
								  '"waybill_routingInfo_area_code": "'+custom_Data.waybill_routingInfo_area_code+'",'+  //集包代码
								  '"waybill_routingInfo_area_code4": "'+custom_Data.waybill_routingInfo_area_code4+'",'+  //安能四段码
								  '"waybill_routingInfo_code": "'+custom_Data.waybill_routingInfo_code+'",'+  //包裹编码
								  '"waybill_goods_images": "'+custom_Data.waybill_goods_images+'",'+  //二维码或图片
								  '"waybill_goods_img": "'+custom_Data.waybill_goods_img+'",'+  //图片
								  '"waybill_goods_money": "'+custom_Data.waybill_goods_money+'",'+  //金额合计
								  '"waybill_goods_money_w": "'+custom_Data.waybill_goods_money_w+'",'+  //金额大写
								  '"waybill_recipient_province_j": "'+custom_Data.waybill_recipient_province_j+'",'+  //收件人简省
								  '"waybill_ordersn": "'+custom_Data.waybill_ordersn+'",'+  //订单编号
								  '"waybill_print_data": "'+custom_Data.waybill_print_data+'",'+  //打印日期
								  '"waybill_print_time": "'+custom_Data.waybill_print_time+'",'+  //打印时间
								  '"waybill_pay_type": "'+custom_Data.waybill_pay_type+'",'+  //付款方式
								  '"waybill_pay_time": "'+custom_Data.waybill_pay_time+'",'+  //付款时间
								  '"waybill_invoice_w": "'+custom_Data.waybill_invoice_w+'",'+  //横线  
		                    	  '"waybill_invoice_h": "'+custom_Data.waybill_invoice_h+'"'+ //竖线
		                    '}'+
		                '}'+
		            ']'+
		        '},';
//			}); 
		}else{ //热敏三联或者两联 
			$.each(data, function(k,v) {  
				var goods = '';
				var i = 1;
				$.each(v.print_data.data.item,function(k2,v2) {
					goods += "商品"+i+":"+v2.title+" 属性:"+v2.sku_properties_na+" 数量:"+v2.buy_num+"\n";//数据库获取当前商品信息
					i++;
				})  
				goods = goods.substr(0, goods.length - 2);//商品信息，从开始截取到倒数第二位，（截取最后一个商品信息，因为此处商品信息不需要换行）    
		        printData += '{'+
		            'documentID : "'+data.waybill_code+'",'+
		            'contents : ['+  
		                '{'+
		                	'templateURL :"'+v.print_data.templateURL+'",'+
		                    '"data": {'+
		                      '"recipient": {'+ 
		                        '"address": {'+
		                          '"city": "'+v.print_data.data.recipient.address.city+'",'+
		                          '"detail": "'+v.print_data.data.recipient.address.detail+'",'+
		                          '"district": "'+v.print_data.data.recipient.address.district+'",'+
		                          '"province": "'+v.print_data.data.recipient.address.province+'",'+
		                          '"town": ""'+
		                        '},'+
		                        '"mobile": "'+v.print_data.data.recipient.mobile+'",'+
		                        '"name": "'+v.print_data.data.recipient.name+'",'+
		                        '"phone": "'+v.print_data.data.recipient.phone+'"'+ 
		                      '},'+
		                      '"routingInfo": {'+
		                        '"consolidation": {'+
		                          '"name": "'+v.print_data.data.routingInfo.consolidation.name+'",'+
		                          '"code": ""'+
		                        '},'+
		                        '"origin": {'+
		                          '"code": "'+v.print_data.data.routingInfo.origin.code+'",'+
		                        '},'+
		                        '"sortation": {'+
		                          '"name": "'+v.print_data.data.routingInfo.sortation.name+'",'+
		                        '},'+
		                        '"routeCode": "'+v.print_data.data.routingInfo.routeCode+'",'+
		                      '},'+
		                      '"sender": {'+
		                        '"address": {'+
		                          '"city": "'+v.print_data.data.sender.address.city+'",'+
		                          '"detail": "'+v.print_data.data.sender.address.detail+'",'+
		                          '"district": "'+v.print_data.data.sender.address.district+'",'+
		                          '"province": "'+v.print_data.data.sender.address.province+'",'+
		                          '"town": ""'+
		                        '},'+
		                        '"mobile": "'+v.print_data.data.sender.mobile+'",'+
		                        '"name": "'+v.print_data.data.sender.name+'",'+
		                        '"phone": "'+v.print_data.data.sender.phone+'",'+
		                      '},'+
		                      '"shippingOption": {'+
		                        '"code": "'+v.print_data.data.shippingOption.code+'",'+
		                        '"title": "'+v.print_data.data.shippingOption.title+'",'+
		                      '},'+
		                      '"waybillCode": "'+data.waybill_code+'",'+ 
		                    '}'+
		                '},'+
		                '{'+ 
		                    'templateURL : "'+customUrl+'",'+//自定义模板生成的文件夹
		                    'data : {'+
		                    	  '"waybill_sender_name": "'+custom_Data.waybill_sender_name+'",'+  //寄件人
		                    	  '"waybill_sender_postcode": "'+custom_Data.waybill_sender_postcode+'",'+  //寄件人邮编 
		                    	  '"waybill_sender_province": "'+custom_Data.waybill_sender_province+'",'+ //寄件人省
		                    	  '"waybill_sender_city": "'+custom_Data.waybill_sender_city+'",'+  //寄件人市
		                    	  '"waybill_sender_district": "'+custom_Data.waybill_sender_district+'",'+  //寄件人区
		                    	  '"waybill_sender_town": "'+custom_Data.waybill_sender_town+'",'+  //寄件人街道
		                    	  '"waybill_sender_detail": "'+custom_Data.waybill_sender_detail+'",'+  //寄件人完整街道
		                    	  '"waybill_sender_phone": "'+custom_Data.waybill_sender_phone+'",'+  //寄件人打电话
		                    	  '"waybill_sender_mobile": "'+custom_Data.waybill_sender_mobile+'",'+  //寄件人手机
		                    	  
		                    	  '"waybill_sender_tel": "'+custom_Data.waybill_sender_tel+'",'+  //寄件人手机/电话
		                    	  '"waybill_sender_company": "'+custom_Data.waybill_sender_company+'",'+  //寄件人公司
		                    	  '"waybill_sender_num1": "'+custom_Data.waybill_sender_num1+'",'+  //寄件人自定义1
		                    	  '"waybill_sender_num2": "'+custom_Data.waybill_sender_num2+'",'+  //寄件人自定义2
		                    	  '"waybill_sender_num3": "'+custom_Data.waybill_sender_num3+'",'+  //寄件人自定义3
		                    	  '"waybill_sender_id": "'+custom_Data.waybill_sender_id+'",'+  //寄件人id
		                    	  '"waybill_sender_note": "'+custom_Data.waybill_sender_note+'",'+  //卖家备注
		                    	  '"waybill_store_name": "'+custom_Data.waybill_store_name+'",'+  //店铺名称
		                    	  '"waybill_recipient_note": "'+custom_Data.waybill_recipient_note+'",'+  //买家留言 
		                    	  
		                    	  '"waybill_recipient_name": "'+custom_Data.waybill_recipient_name+'",'+  //收件人
		                    	  '"waybill_recipient_id": "'+custom_Data.waybill_recipient_id+'",'+  //收件人id
		                    	  '"waybill_recipient_postcode": "'+custom_Data.waybill_recipient_postcode+'",'+  //收件人邮编
		                    	  '"waybill_recipient_province": "'+custom_Data.waybill_recipient_province+'",'+  //收件人省
		                    	  '"waybill_recipient_city": "'+custom_Data.waybill_recipient_city+'",'+  //收件人市
		                    	  '"waybill_recipient_district": "'+custom_Data.waybill_recipient_district+'",'+  //收件人区
		                    	  '"waybill_recipient_town": "'+custom_Data.waybill_recipient_town+'",'+  //收件人街道
		                    	  '"waybill_recipient_detail": "'+custom_Data.waybill_recipient_detail+'",'+  //收件人完整地址 
		                    	  '"waybill_recipient_phone": "'+custom_Data.waybill_recipient_phone+'",'+  //收件人电话
	                    	      '"waybill_recipient_mobile": "'+custom_Data.waybill_recipient_mobile+'",'+  //收件人手机
		                    	  '"waybill_recipient_tel": "'+custom_Data.waybill_recipient_tel+'",'+  //收件人手机/电话
		                    	  
		                    	  '"waybill_goods_count": "'+custom_Data.waybill_goods_count+'",'+  //商品数量合计
		                    	  '"waybill_goods_weight": "'+custom_Data.waybill_goods_weight+'",'+  //商品重量合计
		                    	  '"waybill_invoice_title": "'+custom_Data.waybill_invoice_title+'",'+  //发票抬头
		                    	  '"waybill_sender_station": "'+custom_Data.waybill_sender_station+'",'+  //始发站点
	                    	      '"waybill_sender_station_code": "'+custom_Data.waybill_sender_station_code+'",'+  //始发编号
		                    	  '"waybill_sender_station_code128": "'+custom_Data.waybill_sender_station_code128+'",'+  //始发编号128A
		                    	  '"waybill_recipient_station": "'+custom_Data.waybill_recipient_station+'",'+  //目的站点
		                    	  '"waybill_recipient_station_code": "'+custom_Data.waybill_recipient_station_code+'",'+  //末端分拣号
		                    	  '"waybill_recipient_station_code128": "'+custom_Data.waybill_recipient_station_code128+'",'+  //末端分拣号128
								  '"waybill_routingInfo": "'+custom_Data.waybill_routingInfo+'",'+  //大头笔
								  '"waybill_routingInfo_area": "'+custom_Data.waybill_routingInfo_area+'",'+  //集包地
								  '"waybill_routingInfo_area_code": "'+custom_Data.waybill_routingInfo_area_code+'",'+  //集包代码
								  '"waybill_routingInfo_area_code4": "'+custom_Data.waybill_routingInfo_area_code4+'",'+  //安能四段码
								  '"waybill_routingInfo_code": "'+custom_Data.waybill_routingInfo_code+'",'+  //包裹编码
								  '"waybill_goods_images": "'+custom_Data.waybill_goods_images+'",'+  //二维码或图片
								  '"waybill_goods_img": "'+custom_Data.waybill_goods_img+'",'+  //图片
								  '"waybill_goods_money": "'+custom_Data.waybill_goods_money+'",'+  //金额合计
								  '"waybill_goods_money_w": "'+custom_Data.waybill_goods_money_w+'",'+  //金额大写
								  '"waybill_recipient_province_j": "'+custom_Data.waybill_recipient_province_j+'",'+  //收件人简省
								  '"waybill_ordersn": "'+custom_Data.waybill_ordersn+'",'+  //订单编号
								  '"waybill_print_data": "'+custom_Data.waybill_print_data+'",'+  //打印日期
								  '"waybill_print_time": "'+custom_Data.waybill_print_time+'",'+  //打印时间
								  '"waybill_pay_type": "'+custom_Data.waybill_pay_type+'",'+  //付款方式
								  '"waybill_pay_time": "'+custom_Data.waybill_pay_time+'",'+  //付款时间
								  '"waybill_invoice_w": "'+custom_Data.waybill_invoice_w+'",'+  //横线  
		                    	  '"waybill_invoice_h": "'+custom_Data.waybill_invoice_h+'"'+ //竖线
		                    '}'+
		                '}'+
		            ']'+
		        '},';
			}); 
		}
		printData += ']';//documtents中的有半括号 
		printData=eval('(' + printData + ')');//printData是字符串，使用eval("("+printData+")")可以将其转换为json对象，和JSON.parse的功能一样。  
		request.task = { 
		    taskID: getUUID(8,10),
	        preview: preview,  //如果为true，则是预览模式，为false，则直接打印
	        previewType:"image",//如果是预览模式，是以pdf还是image方式预览，二选一，此属性不是必选，默认以pdf预览。
	        printer: printer,
	        notifyMode:"allInOne",//打印结果通知模式，是逐个document通知还是批量一次通知最终打印结果
	        firstDocumentNumber:data.waybill_code,// v0.2.8.3 新增：task 起始 document 序号
	        totalDocumentCount:1,// v0.2.8.3 本次新增task document 总数
            documents : printData
		} 
	    socket.send(JSON.stringify(request));
	}  
	
	function doPrint1(printer,data,preview){ 
		var request  = getRequestObject("print");  
		//console.log(data.waybill_code);
		//data.waybill_code = 33333333333; //预览时，随便传值，但打印必须传模板的code   
		var printData = '[';
		$.each(data,function(k,v) {//遍历获得打印/预览的数据，存到printData数组。  
			waybill_code=v.waybill_code;
//			if(preview){
//				waybill_code=9892718606093;
//			}
			var goods = '';
			var i = 1;
			$.each(v.print_data.data.item,function(k2,v2) {
				goods += "商品"+i+":"+v2.title+" 属性:"+v2.sku_properties_na+" 数量:"+v2.buy_num+"\n";//数据库获取当前商品信息
				i++;
			})  
			goods = goods.substr(0, goods.length - 2);//商品信息，从开始截取到倒数第二位，（截取最后一个商品信息，因为此处商品信息不需要换行）    
	        printData += '{'+
	            'documentID : "'+waybill_code+'",'+
	            'contents : ['+  
	                '{'+
	               		'templateURL : "http://cloudprint.cainiao.com/template/standard/75704/37",'+
//	                	'templateURL :"'+v.print_data.templateURL+'",'+
	                    '"data": {'+
	                      '"recipient": {'+
	                        '"address": {'+
	                          '"city": "'+v.print_data.data.recipient.address.city+'",'+
	                          '"detail": "'+v.print_data.data.recipient.address.detail+'",'+
	                          '"district": "'+v.print_data.data.recipient.address.district+'",'+
	                          '"province": "'+v.print_data.data.recipient.address.province+'",'+
	                          '"town": ""'+
	                        '},'+
	                        '"mobile": "'+v.print_data.data.recipient.mobile+'",'+
	                        '"name": "'+v.print_data.data.recipient.name+'",'+
	                        '"phone": ""'+
	                      '},'+
	                      '"routingInfo": {'+
	                        '"consolidation": {'+
	                          '"name": "'+v.print_data.data.routingInfo.consolidation.name+'",'+
	                          '"code": ""'+
	                        '},'+
	                        '"origin": {'+
	                          '"code": "'+v.print_data.data.routingInfo.origin.code+'",'+
	                        '},'+
	                        '"sortation": {'+
	                          '"name": "'+v.print_data.data.routingInfo.sortation.name+'",'+
	                        '},'+
	                        '"routeCode": "'+v.print_data.data.routingInfo.routeCode+'",'+
	                      '},'+
	                      '"sender": {'+
	                        '"address": {'+
	                          '"city": "'+v.print_data.data.sender.address.city+'",'+
	                          '"detail": "'+v.print_data.data.sender.address.detail+'",'+
	                          '"district": "'+v.print_data.data.sender.address.district+'",'+
	                          '"province": "'+v.print_data.data.sender.address.province+'",'+
	                          '"town": ""'+
	                        '},'+
	                        '"mobile": "'+v.print_data.data.sender.mobile+'",'+
	                        '"name": "'+v.print_data.data.sender.name+'",'+
	                        '"phone": "'+v.print_data.data.sender.phone+'",'+
	                      '},'+
	                      '"shippingOption": {'+
	                        '"code": "'+v.print_data.data.shippingOption.code+'",'+
	                        '"title": "'+v.print_data.data.shippingOption.title+'",'+
	                      '},'+
	                      '"waybillCode": "'+waybill_code+'",'+ 
	                    '}'+
	                '},'+
	                '{'+
	                    //'templateURL : "http://cloudprint.cainiao.com/template/standard/242902",'+
	                    //'data : {'+
	                          //'"goods": "'+goods+'",'+
	                        //'"goods": "商品信息ing",'+
	                    //'}'+
						'templateURL : "http://cloudprint.cainiao.com/template/standard/243323",'+
	                    'data : {'+
	                    	  '"qcode": "http://www.dianpubang.net",'+    
	                    	  '"rcode": "http://www.baidu.com",'+    
	                    	  '"qinfo": "期待有奇迹产生"'+    
	                    '}'+
	                '}'+
	            ']'+
	        '},';
	    }); 
		printData += ']';//documtents中的有半括号 
		printData=eval('(' + printData + ')');//printData是字符串，使用eval("("+printData+")")可以将其转换为json对象，和JSON.parse的功能一样。  
		request.task = { 
		    taskID: getUUID(8,10),
	        preview: false,  //如果为true，则是预览模式，为false，则直接打印
	        previewType:"image",//如果是预览模式，是以pdf还是image方式预览，二选一，此属性不是必选，默认以pdf预览。
	        printer: printer,
	        notifyMode:"allInOne",//打印结果通知模式，是逐个document通知还是批量一次通知最终打印结果
	        //firstDocumentNumber:data.waybill_code,// v0.2.8.3 新增：task 起始 document 序号
	        totalDocumentCount:1,// v0.2.8.3 本次新增task document 总数
            documents : printData
		} 
	    socket.send(JSON.stringify(request));   
	}
	/***
	 * 条码打印/预览数据协议(print) 
	 * @param printer 当前使用的打印机
	 * @param data 打印或预览的数据
	 * @param customUrl 自定义数据的url
	 * @param preview 如果为true，则是预览模式，为false，则直接打印，默认直接打印
	 * task请求的是商家自定义区数据和url
	 ***/
	function doPrintCode(printer,data,customUrl,preview=false){ 
		var request  = getRequestObject("print");  
		waybill_code = 666666666; //预览时，随便传值，但打印必须传模板的code
		var printData = '[';
		$.each(data,function(k,v) {//遍历获得打印/预览的数据，存到printData数组。   
	        printData += '{'+
	            'documentID : "'+waybill_code+'",'+
	            'contents : ['+  
	                	'{'+ 
						//'templateURL : "http://cloudprint.cainiao.com/template/standard/248411",'+
						//'templateURL : "http://localhost/dianpubang/data/cntpl/business_8/barcode/8_barcode.txt",'+ 
						'templateURL : "'+customUrl+'",'+ 
	                    'data : {'+
	                    	'"codetype": "'+v['barcode']+'"'+ 
	                    '}'+
	                '}'+
	            ']'+
	        '},';
	    }); 
		printData += ']';//documtents中的有半括号 
		printData=eval('(' + printData + ')');//printData是字符串，使用eval("("+printData+")")可以将其转换为json对象，和JSON.parse的功能一样。  
		request.task = { 
		    taskID: getUUID(8,10),
	        preview: preview,  //如果为true，则是预览模式，为false，则直接打印
	        previewType:"image",//如果是预览模式，是以pdf还是image方式预览，二选一，此属性不是必选，默认以pdf预览。
	        printer: printer,
	        notifyMode:"allInOne",//打印结果通知模式，是逐个document通知还是批量一次通知最终打印结果
	        //firstDocumentNumber:data.waybill_code,// v0.2.8.3 新增：task 起始 document 序号
	        totalDocumentCount:1,// v0.2.8.3 本次新增task document 总数
            documents : printData
		} 
	    socket.send(JSON.stringify(request));   
	}
	
	/***
	 * 吊牌打印/预览数据协议(print) 
	 * @param printer 当前使用的打印机
	 * @param data 打印或预览的数据
	 * @param customUrl 自定义数据的url
	 * @param preview 如果为true，则是预览模式，为false，则直接打印，默认直接打印
	 * task请求的是商家自定义区数据和url
	 ***/
	function doPrintCodeTag(printer,data,customUrl,preview=false){ 
		var request  = getRequestObject("print");  
		waybill_code = 666666666; //预览时，随便传值，但打印必须传模板的code
		var printData = '[';
		$.each(data,function(k,v) {//遍历获得打印/预览的数据，存到printData数组。   
	        printData += '{'+
	            'documentID : "'+waybill_code+'",'+
	            'contents : ['+  
	                	'{'+ 
						//'templateURL : "http://cloudprint.cainiao.com/template/standard/244132",'+
						//'templateURL : "http://localhost/dianpubang/data/cntpl/business_8/barcode/8_barcode.txt",'+ 
						'templateURL : "'+customUrl+'",'+
	                    'data : {'+
	                    	'"codetype": "'+v['product_name']+'"'+ //商品名称
	                    '}'+
	                '}'+
	            ']'+
	        '},';
	    }); 
		printData += ']';//documtents中的有半括号 
		printData=eval('(' + printData + ')');//printData是字符串，使用eval("("+printData+")")可以将其转换为json对象，和JSON.parse的功能一样。  
		request.task = { 
		    taskID: getUUID(8,10),
	        preview: preview,  //如果为true，则是预览模式，为false，则直接打印
	        previewType:"image",//如果是预览模式，是以pdf还是image方式预览，二选一，此属性不是必选，默认以pdf预览。
	        printer: printer,
	        notifyMode:"allInOne",//打印结果通知模式，是逐个document通知还是批量一次通知最终打印结果
	        //firstDocumentNumber:data.waybill_code,// v0.2.8.3 新增：task 起始 document 序号
	        totalDocumentCount:1,// v0.2.8.3 本次新增task document 总数
            documents : printData
		} 
	    socket.send(JSON.stringify(request));   
	}
	
	/***
	 * 拣货单打印/预览数据协议(print) 
	 * @param printer 当前使用的打印机
	 * @param data 打印或预览的数据
	 * @param customUrl 自定义数据的url
	 * @param preview 如果为true，则是预览模式，为false，则直接打印，默认直接打印
	 * task请求的是商家自定义区数据和url
	 ***/
	function doPrintPicking(printer,data,customData,customUrl,preview=false){ 
		var request  = getRequestObject("print");  
		waybill_code = 123456789; //预览时，随便传值，但打印必须传模板的code 
		var printData = '[';
		printData +='{'+
	            '"documentID" : "'+waybill_code+'",'+
	            '"contents" : [{'+  
	                    'data : {'+
	                    	'"picking_ec_name": "木木三专卖店",'+ //拣货店铺
	                    	'"picking_num_goods":"'+customData['num_goods']+'",'+//拣货总数量 
	                    	'"picking_num_money":"'+customData['num_money']+'",'+//拣货总金额
	                    	'"picking_op_name":"'+customData['op_name']+'",'+//拣货人
	                    	'tabletest : [';
							$.each(data,function(k,v) {//遍历获得打印/预览的数据，存到printData数组。
								k++;
						        printData += '{'+
					        		'"picking_number": "'+k+'",'+ //序号
					        		'"picking_picture": "'+v['stock_imgurl']+'",'+ //商品图片
					        		'"picking_name": "'+v['product_name']+'",'+ //商品名称
					        		'"picking_code": "'+v['style_code']+'",'+ //款式编码
					        		'"picking_spec": "'+v['spec']+'",'+ //商品编码+颜色规格
					        		'"picking_num": "'+v['num']+'",'+ //数量
					        		'"picking_depot": "'+v['depot_pos']+'",'+ //仓位
					        		'"picking_barcode": "'+v['stock_code']+'"'+ //条形码
				        		'},'
					   		}); 
		printData +=']'+
                '},'+
                	'templateURL : "'+customUrl+'"'+
	            '}]'+
	        '},';
		printData += ']';//documtents中的有半括号 
		printData=eval('(' + printData + ')');//printData是字符串，使用eval("("+printData+")")可以将其转换为json对象，和JSON.parse的功能一样。  
		request.task = { 
		    taskID: getUUID(8,10),
	        preview: preview,  //如果为true，则是预览模式，为false，则直接打印
	        previewType:"image",//如果是预览模式，是以pdf还是image方式预览，二选一，此属性不是必选，默认以pdf预览。
	        printer: printer,
	        notifyMode:"allInOne",//打印结果通知模式，是逐个document通知还是批量一次通知最终打印结果
	        //firstDocumentNumber:data.waybill_code,// v0.2.8.3 新增：task 起始 document 序号
	        totalDocumentCount:1,// v0.2.8.3 本次新增task document 总数
            documents: printData
		} 
		//document.write(JSON.stringify(printData)); 
	    socket.send(JSON.stringify(request));   
	}