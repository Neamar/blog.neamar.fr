<?php
$url = parse_url(getenv("DATABASE_URL"));

class JConfig {
	public $offline = '0';
	public $offline_message = 'Ce site est en maintenance.<br /> Merci de revenir ultérieurement.';
	public $display_offline_message = '1';
	public $offline_image = '';
	public $sitename = 'Blog de Neamar';
	public $editor = 'none';
	public $captcha = '0';
	public $list_limit = '20';
	public $access = '1';
	public $debug = '0';
	public $debug_lang = '0';
	public $dbtype = 'mysql';
	public $host;
	public $user;
	public $password;
	public $db = 'blog';
	public $dbprefix = 'blog_';
	public $live_site = '';
	public $secret = 'Z2lnYoV0VGC159M0';
	public $gzip = '0';
	public $error_reporting = 'default';
	public $helpurl = 'http://help.joomla.org/proxy/index.php?option=com_help&keyref=Help{major}{minor}:{keyref}';
	public $ftp_host = '';
	public $ftp_port = '';
	public $ftp_user = '';
	public $ftp_pass = '';
	public $ftp_root = '';
	public $ftp_enable = '0';
	public $offset = 'UTC';
	public $mailer = 'mail';
	public $mailfrom = 'neamar@neamar.fr';
	public $fromname = 'Blog de Neamar';
	public $sendmail = '/usr/sbin/sendmail';
	public $smtpauth = '0';
	public $smtpuser = '';
	public $smtppass = '';
	public $smtphost = 'localhost';
	public $smtpsecure = 'none';
	public $smtpport = '25';
	public $caching = '0';
	public $cache_handler = 'file';
	public $cachetime = '15';
	public $MetaDesc = 'Distributeur de liens !';
	public $MetaKeys = '';
	public $MetaTitle = '1';
	public $MetaAuthor = '1';
	public $MetaVersion = '0';
	public $robots = '';
	public $sef = '1';
	public $sef_rewrite = '1';
	public $sef_suffix = '0';
	public $unicodeslugs = '0';
	public $feed_limit = '10';
	public $log_path = '/tmp';
	public $tmp_path = '/tmp';
	public $lifetime = '15';
	public $session_handler = 'database';
	public $MetaRights = '';
	public $sitename_pagetitles = '0';
	public $force_ssl = '0';
	public $feed_email = 'author';
	public $cookie_domain = '';
	public $cookie_path = '';

	public function __construct() {
		$this->host = $url["host"];
		$this->user = $url["user"];
		$this->password = $url["pass"];
	}
}
