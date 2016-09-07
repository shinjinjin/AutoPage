<?
	//$deviceToken='ba5570f3883bdba664c0978009eeade025749716577b0129fe8da307cd8a5c0d';
	//$pem = '/var/www/vhosts/topapp.com.tw/httpdocs/AppPlus/attachments/date_201302/6a38af4eb5192f66fbfa084c3698d7f7.pem'; 
	//$meg='123123123123';
	//$gcm = new Apsn_push($pem);
	//echo $gcm->pushNotification($deviceToken,$meg);
	define ( 'API_ROOT_PATH', dirname( __FILE__));
	require_once ( API_ROOT_PATH . '/lib/RequestCore.class.php' );
	require_once ( API_ROOT_PATH . '/lib/ChannelException.class.php' );
    require_once ( API_ROOT_PATH . '/lib/BaeBase.class.php' );
	echo API_ROOT_PATH;

class Baidu_push extends BaeBase
{
/*	
	var $baibu_url='http://channel.api.duapp.com/rest/2.0/channel/channel'; 
			
	var $method='push_msg';		//方法名，必须存在：push_msg
	
	var $apikey='';			//	
	
	var $push_type=1;		/*推送類型，取值範圍為：1〜3
							1：單個人，必須指定USER_ID和CHANNEL_ID（指定用戶的指定設備）或者USER_ID（指定用戶的所有設備）
							
							2：一群人，必須指定標籤
							
							3：所有人，無需指定標籤，USER_ID，CHANNEL_ID	*

	var $messages='';		//訊息
							
	var $msg_keys='testkey';		//消息標籤
	
	var $timestamp='';		//時間戳記
		
	var $sign='';			//簽名值*/
	
	const TIMESTAMP = 'timestamp';
	/**
	 * 请求过期的时间
	 * 
	 * 如果不填写，默认为10分钟
	 * 
	 * @var int EXPIRES
	 */
	const EXPIRES = 'expires';
	/**
	 * API版本号
	 * 
	 * 用户一般不需要关注此项
	 * 
	 * @var int VERSION
	 */
	const VERSION = 'v';
	/**
	 * 消息通道ID号
	 * 
	 * @var int CHANNEL_ID
	 */
	const CHANNEL_ID = 'channel_id';
	/**
	 * 用户ID的类型
	 * 
	 * 0：百度用户标识对称加密串；1：百度用户标识明文
	 * 
	 * @var string USER_TYPE
	 */
	const USER_TYPE = 'user_type';
	/**
	 * 设备类型
	 * 
	 * 1：浏览器设备；2：PC设备；3：andorid设备
	 * 
	 * @var int DEVICE_TYPE
	 */
	const DEVICE_TYPE = 'device_type';
	/**
	 * 第几页
	 * 
	 * 批量查询时，需要指定start，默认为第0页
	 * 
	 * @var int START
	 */
	const START = 'start';
	/**
	 * 每页多少条记录
	 * 
	 * 批量查询时，需要指定limit，默认为100条
	 * 
	 * @var int LIMIT
	 */
	const LIMIT = 'limit';
	/**
	 * 消息ID json字符串
	 * 
	 * @var string MSG_IDS
	 */
	const MSG_IDS = 'msg_ids';
	const MSG_KEYS = 'msg_keys';
	const IOS_MESSAGES = 'ios_messages';
	const WP_MESSAGES = 'wp_messages';
	/**
	 * 消息类型
	 * 
	 * 扩展类型字段，0：默认类型
	 * 
	 * @var int MESSAGE_TYPE
	 */
	const MESSAGE_TYPE = 'message_type';
	/**
	 * 消息超时时间
	 * 
	 * @var int MESSAGE_EXPIRES
	 */
	const MESSAGE_EXPIRES = 'message_expires';
    
    /**
     * 消息标签名称
     * 
     * @var string TAG_NAME
     */
    const TAG_NAME = 'tag';
    
    /**
     * 消息标签描述
     * 
     * @var stirng TAG_INFO
     */
    const TAG_INFO = 'info';
    
    /**
     * 消息标签id
     * 
     * @var int TAG_ID
     */
    const TAG_ID = 'tid';
    
    /**
     * 封禁时间
     * 
     * @var int BANNED_TIME
     */
    const BANNED_TIME = 'banned_time';
    
    /**
     * 回调域名
     * 
     * @var string CALLBACK_DOMAIN
     */
    const CALLBACK_DOMAIN = 'domain';
    
    /**
     * 回调uri
     * 
     * @var string CALLBACK_URI
     */
    const CALLBACK_URI = 'uri';

	/**
	 * Channel常量
	 * 
	 * 用户关注：否
	 */
	const APPID = 'appid';
	const ACCESS_TOKEN = 'access_token';
	const API_KEY = 'apikey';
	const SECRET_KEY = 'secret_key';
	const SIGN = 'sign';
	const METHOD = 'method';
	const HOST = 'host';
	const USER_ID = 'user_id';
	const MESSAGES = 'messages';
	const PRODUCT = 'channel';
	
	const DEFAULT_HOST = 'channel.api.duapp.com';
	const NAME = "name";
	const DESCRIPTION = "description";
	const CERT = "cert"; 
	const RELEASE_CERT = "release_cert";
	const DEV_CERT = "dev_cert";
	const PUSH_TYPE = 'push_type';
	
	/**
	 * Channel私有变量
	 * 
	 * 用户关注：否
	 */
	protected $_apiKey = NULL;
	protected $_secretKey = NULL;
	protected $_requestId = 0;
	protected $_curlOpts = array(
        CURLOPT_TIMEOUT => 30,
        CURLOPT_CONNECTTIMEOUT => 5
        );

	const PUSH_TO_USER = 1;
	const PUSH_TO_TAG = 2;
	const PUSH_TO_ALL = 3;
	const PUSH_TO_DEVICE = 4;

	/**
	 * Channel 错误常量
	 * 
	 * 用户关注：否
	 */
	const CHANNEL_SDK_SYS = 1;
	const CHANNEL_SDK_INIT_FAIL = 2;
	const CHANNEL_SDK_PARAM = 3;
	const CHANNEL_SDK_HTTP_STATUS_ERROR_AND_RESULT_ERROR = 4;
	const CHANNEL_SDK_HTTP_STATUS_OK_BUT_RESULT_ERROR = 5;
	
	public function pushMessage($pushType, $messages, $msgKeys, $optional = NULL)
	{
		$this->_resetErrorStatus();
		try
		{
			$tmpArgs = func_get_args();
			$arrArgs = $this->_mergeArgs (array(self::PUSH_TYPE , self::MESSAGES, self::MSG_KEYS), $tmpArgs);
			$arrArgs[self::METHOD] = 'push_msg';

			switch($pushType)
			{
				case self::PUSH_TO_USER:
					if ( !array_key_exists(self::USER_ID, $arrArgs) || empty($arrArgs[self::USER_ID])){
						throw new ChannelException("userId should be specified in optional[] when pushType is PUSH_TO_USER", self::CHANNEL_SDK_PARAM);
					}
					break;
	
				case self::PUSH_TO_TAG:
					if (!array_key_exists(self::TAG_NAME, $arrArgs) || empty($arrArgs[self::TAG_NAME])){
						throw new ChannelException("tag should be specified in optional[] when pushType is PUSH_TO_TAG", self::CHANNEL_SDK_PARAM);
					}
					break;
		
				case self::PUSH_TO_ALL:
					break;

				case self::PUSH_TO_DEVICE:
					if (!array_key_exists(self::CHANNEL_ID, $arrArgs)){
						throw new ChannelException("channelId should be specified in optional[] when pushType is PUSH_TO_DEVICE", self::CHANNEL_SDK_PARAM);
					}
					break;
				default:
					throw new ChannelException("pushType value is not supported or not specified", self::CHANNEL_SDK_PARAM);
			}

			$arrArgs[self::PUSH_TYPE] = $pushType;
			if(is_array($arrArgs [ self::MESSAGES ])) {
                $arrArgs [ self::MESSAGES ] = json_encode($arrArgs [ self::MESSAGES ]);
            }
            if(is_array($arrArgs [ self::MSG_KEYS ])) {
                $arrArgs [ self::MSG_KEYS ] = json_encode($arrArgs [ self::MSG_KEYS ]);
            }
            return $this->_commonProcess ( $arrArgs );
		}
		catch (Exception $ex)
		{
			$this->_channelExceptionHandler( $ex );
			return false;
		}
	}

	
	/**
	 * _checkString
	 *  
	 * 用户关注：否
	 * 
	 * 检查参数是否是一个大于等于$min且小于等于$max的字符串
	 * 
	 * @access protected
	 * @param string $str 要检查的字符串
	 * @param int $min 字符串最小长度
	 * @param int $max 字符串最大长度
	 * @return 成功：true；失败：false
	 * 
	 * @version 1.0.0.0
	 */
	protected function _checkString($str, $min, $max)
	{
		if (is_string($str) && strlen($str) >= $min && strlen($str) <= $max) {
			return true;
		}
		return false;
	}

    /**
     * _getKey
     * 
     * 用户关注：否
     * 获取AK/SK/TOKEN/HOST的统一过程函数
     * 
     * @access protected
     * @param array $opt 参数数组
     * @param string $opt_key 参数数组的key
     * @param string $member 对象成员
     * @param string $g_key 全局变量的名字
     * @param string $env_key 环境变量的名字
     * @param int $min 字符串最短值
     * @param int $max 字符串最长值
     * @throws ChannelException 如果出错，则抛出ChannelException异常，异常类型为self::CHANNEL_SDK_PARAM
     * 
     * @version 1.0.0.0
     */
	protected function _getKey(&$opt,
            $opt_key,
            $member,
            $g_key,
            $env_key,
            $min,
            $max,
            $throw = true)
    {
        $dis = array(
            'access_token' => 'access_token',
            );
        global $$g_key;
        if (isset($opt[$opt_key])) {
            if (!$this->_checkString($opt[$opt_key], $min, $max)) {
                throw new ChannelException ( 'invalid ' . $dis[$opt_key] . ' in $optinal ('
                        . $opt[$opt_key] . '), which must be a ' . $min . '-' . $max
                        . ' length string', self::CHANNEL_SDK_PARAM );
            }
            return;
        }
        if ($this->_checkString($member, $min, $max)) {
            $opt[$opt_key] = $member;
            return;
        }
        if (isset($$g_key)) {
            if (!$this->_checkString($$g_key, $min, $max)) {
                throw new ChannelException('invalid ' . $g_key . ' in global area ('
                        . $$g_key . '), which must be a ' . $min . '-' . $max
                        . ' length string', self::CHANNEL_SDK_PARAM);
            }
            $opt[$opt_key] = $$g_key;
            return;
        }

        if (false !== getenv($env_key)) {
            if (!$this->_checkString(getenv($env_key), $min, $max)) {
                throw new ChannelException( 'invalid ' . $env_key . ' in environment variable ('
                        . getenv($env_key) . '), which must be a ' . $min . '-' . $max
                        . ' length string', self::CHANNEL_SDK_PARAM);
            }
            $opt[$opt_key] = getenv($env_key) ;
            return;
        }

        if ($opt_key === self::HOST) {
            $opt[$opt_key] = self::DEFAULT_HOST;
            return;
        }
        if ($throw) {
            throw new ChannelException('no param (' . $dis[$opt_key] . ') was found',
                    self::CHANNEL_SDK_PARAM);
        }
    }

	/**
	 * _adjustOpt
	 *   
	 * 用户关注：否
	 * 
	 * 参数调整方法
	 * 
	 * @access protected
	 * @param array $opt 参数数组
	 * @throws ChannelException 如果出错，则抛出异常，异常号为 self::CHANNEL_SDK_PARAM
	 * 
	 * @version 1.0.0.0
	 */
	protected function _adjustOpt(&$opt)
    {
		if (!isset($opt) || empty($opt) || !is_array($opt)) {
			throw new ChannelException('no params are set',self::CHANNEL_SDK_PARAM);
		}
		if (!isset($opt[self::TIMESTAMP])) {
			$opt[self::TIMESTAMP] = time();
		}
		$this->_getKey($opt, self::HOST, null, 'g_host',
                'HTTP_BAE_ENV_ADDR_CHANNEL', 1, 1024);

        $this->_getKey($opt, self::API_KEY, $this->_apiKey,
                'g_apiKey', 'HTTP_BAE_ENV_AK', 1, 64, false);	
		//$opt[self::HOST] = self::DEFAULT_HOST; 
		//$opt[self::API_KEY] = $this->_apiKey;
        
		if (isset($opt[self::SECRET_KEY])) {
			unset($opt[self::SECRET_KEY]);
		}
	}

	/**
	 * _genSign
	 *
	 *用户关注： 否
	 *
	 * 根据method, url, 参数内容 生成签名
	*/
	protected function _genSign($method, $url, $arrContent)
	{
    	//$secret_key = $this->_secretKey;
		$opt = array();
		$this->_getKey($opt, self::SECRET_KEY, $this->_secretKey,
                'g_secretKey', 'HTTP_BAE_ENV_SK', 1, 64, false);
		$secret_key = $opt[self::SECRET_KEY];

    	$gather = $method.$url;
    	ksort($arrContent);
    	foreach($arrContent as $key => $value)
   		{
        	$gather .= $key.'='.$value;
    	}
    	$gather .= $secret_key;
    	$sign = md5(urlencode($gather));
    	return $sign;
	}

	/**
	 * _baseControl
	 *   
	 * 用户关注：否
	 * 
	 * 网络交互方法
	 * 
	 * @access protected
	 * @param array $opt 参数数组
	 * @throws ChannelException 如果出错，则抛出异常，错误号为self::CHANNEL_SDK_SYS
	 * 
	 * @version 1.0.0.0
	 */
	protected function _baseControl($opt)
	{
		$content = '';
		$resource = 'channel';
		if (isset($opt[self::CHANNEL_ID]) && !is_null($opt[self::CHANNEL_ID])) {
			$resource = $opt[self::CHANNEL_ID];
			unset($opt[self::CHANNEL_ID]);
		}
		$host = $opt[self::HOST];
		unset($opt[self::HOST]);
		
		$url = 'http://' . $host . '/rest/2.0/' . self::PRODUCT . '/';
		$url .= $resource;
		$http_method = 'POST';
		$opt[self::SIGN] = $this->_genSign($http_method, $url, $opt);
		
		foreach ($opt as $k => $v) {
			$k = urlencode($k);
			$v = urlencode($v);
			$content .= $k . '=' . $v . '&';
		}
		$content = substr($content, 0, strlen($content) - 1);

		$request = new RequestCore($url);
		$headers['Content-Type'] = 'application/x-www-form-urlencoded';
		$headers['User-Agent'] = 'Baidu Channel Service Phpsdk Client';
		foreach ($headers as $headerKey => $headerValue) {
			$headerValue = str_replace(array("\r", "\n"), '', $headerValue);
			if($headerValue !== '') {
				$request->add_header($headerKey, $headerValue);
			}
		}
		$request->set_method($http_method);
		$request->set_body($content);
		if (is_array($this->_curlOpts)) {
			$request->set_curlopts($this->_curlOpts);
		}
		$request->send_request();
		return new ResponseCore($request->get_response_header(),
                $request->get_response_body(),
                $request->get_response_code());
	}

	/**
	 * _channelExceptionHandler
	 *   
	 * 用户关注：否
	 * 
	 * 异常处理方法
	 * 
	 * @access protected
	 * @param Excetpion $ex 异常处理函数，主要是填充Channel对象的错误状态信息
	 * 
	 * @version 1.0.0.0
	 */
	protected function _channelExceptionHandler($ex)
	{
		$tmpCode = $ex->getCode();
		if (0 === $tmpCode) {
			$tmpCode = self::CHANNEL_SDK_SYS;
		}

		$this->errcode = $tmpCode;
		if ($this->errcode >= 30000) {
			$this->errmsg = $ex->getMessage();
		} else {	
			$this->errmsg = $this->_arrayErrorMap[$this->errcode] . ',detail info['
                    . $ex->getMessage() . ',break point:' . $ex->getFile() . ':'
                    . $ex->getLine() . '].';
		}
	}

	/**
	 * _commonProcess
	 *   
	 * 用户关注：否
	 * 
	 * 所有服务类SDK方法的通用过程
	 * 
	 * @access protected
	 * @param array $paramOpt 参数数组
	 * @param array $arrNeed 必须的参数KEY
	 * @throws ChannelException 如果出错，则抛出异常
	 * 
	 * @version 1.0.0.0
	 */
	protected function _commonProcess($paramOpt = NULL)
	{
		$this->_adjustOpt($paramOpt);
		$ret = $this->_baseControl($paramOpt);
		if (empty($ret)) {
			throw new ChannelException('base control returned empty object',
                    self::CHANNEL_SDK_SYS);
		}
		if ($ret->isOK()) {
			$result = json_decode($ret->body, true);
			if (is_null($result)) {
				throw new ChannelException($ret->body,
                        self::CHANNEL_SDK_HTTP_STATUS_OK_BUT_RESULT_ERROR);
			}
			$this->_requestId = $result['request_id'];
			return $result;
		}
		$result = json_decode($ret->body,true);
		if (is_null($result)) {
			throw new ChannelException('ret body:' . $ret->body,
                    self::CHANNEL_SDK_HTTP_STATUS_ERROR_AND_RESULT_ERROR);
		}
		$this->_requestId = $result['request_id'];
		throw new ChannelException($result['error_msg'], $result['error_code']);
	}

	/**
	 * _mergeArgs
	 *   
	 * 用户关注：否
	 * 
	 * 合并传入的参数到一个数组中，便于后续处理
	 * 
	 * @access protected
	 * @param array $arrNeed 必须的参数KEY
	 * @param array $tmpArgs 参数数组
	 * @throws ChannelException 如果出错，则抛出异常，异常号为self::Channel_SDK_PARAM 
	 * 

	 * @version 1.0.0.0
	 */
	protected function _mergeArgs($arrNeed, $tmpArgs)
	{
		$arrArgs = array();
		if (0 == count($arrNeed) && 0 == count($tmpArgs)) {
			return $arrArgs;
		}
		if (count($tmpArgs) - 1 != count($arrNeed) && count($tmpArgs) != count($arrNeed)) {
			$keys = '(';
			foreach ($arrNeed as $key) {
                $keys .= $key .= ',';
			}
			if ($keys[strlen($keys) - 1] === '' && ',' === $keys[strlen($keys) - 2]) {
				$keys = substr($keys, 0, strlen($keys) - 2);
			}
			$keys .= ')';
			throw new Exception('invalid sdk params, params' . $keys . 'are needed',
                    self::CHANNEL_SDK_PARAM);
		}
		if( empty($tmpArgs[count($tmpArgs) - 1])){
			$tmpArgs[count($tmpArgs) - 1] = array();
		}		
		if (count($tmpArgs) - 1 == count($arrNeed) && !is_array($tmpArgs[count($tmpArgs) - 1])) {
			throw new Exception('invalid sdk params, optional param must be an array',
                    self::CHANNEL_SDK_PARAM);
		}

		$idx = 0;
		if(!is_null($arrNeed)){
			foreach ($arrNeed as $key) {
				if (!is_integer($tmpArgs[$idx]) && empty($tmpArgs[$idx])) {
					throw new Exception("lack param (${key})", self::CHANNEL_SDK_PARAM);
				}
				$arrArgs[$key] = $tmpArgs[$idx];
				$idx += 1;
			}
		}
		if (isset($tmpArgs[$idx])) {
			foreach ($tmpArgs[$idx] as $key => $value) {
				if ( !array_key_exists($key, $arrArgs) && (is_integer($value) || !empty($value))) {
					$arrArgs[$key] = $value;
				}
			}
		}
		if (isset($arrArgs[self::CHANNEL_ID])) {
			$arrArgs[self::CHANNEL_ID] = urlencode($arrArgs[self::CHANNEL_ID]);
		}
		return $arrArgs;
	}

	/**
	 * _resetErrorStatus
	 *   
	 * 用户关注：否
	 * 
	 * 恢复对象的错误状态，每次调用服务类方法时，由服务类方法自动调用该方法
	 * 
	 * @access protected
	 * 
	 * @version 1.0.0.0
	 */
	protected function _resetErrorStatus()
	{
		$this->errcode = 0;
		$this->errmsg = $this->_arrayErrorMap[$this->errcode];
		$this->_requestId = 0;
	}
}
?>