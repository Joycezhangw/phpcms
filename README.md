# phpcms
> 该仓库是在phpcms v9.6.3的镜像基础上进行维护

## do what
* 拆除功能
    * video及视频库相关
    * phpsso及相关
    * 盛大登录 和 腾讯微博登录
    * upgrade在线升级
    * 后台首页去掉多余展示块
    * 移除原先短信模块
* 支持https
* 漏洞修复
* 无用文件清理
* 通过h5上传头像
* 升级ckeditor到V4，去掉原swf方式上传改为H5实现
* 将原先短信平台修改成阿里云短信

## 后台多处出现 跨站点脚本（XSS）攻击
在后台关键字搜索中输入`x"><script>alert(123)</script><"`，会在页面直接js弹窗。
目前仅在 nginx 进行修复，自定义错误页面
```relax-ng
error_page  505  /505.html;
location = /505.html {
    root   /etc/nginx/html;
}
if ($query_string ~ "(<|%3C).*script.*(>|%3E)") { return 505; }
```
## 关于 SQL 注入、XSS 攻击

> SQL 注入、XSS 攻击会绕过 CDN 缓存规则直接回源请求，造成 PHP、MySQL 运算请求越来越多，服务器负载飙升。在日志里可以看到几乎大部分都是 GET/POST 形式的请求，虽然 waf 都完美的识别和拦截了，但是因为是 Nginx 层面应对措施，所以还是会对服务器负载形成一定的压力，最有效的办法就是在 Nginx 里加入了防止 SQL 注入、XSS 攻击的配置。具体做法如下：

> 将下面的 Nginx 配置文件代码放入到对应站点的.conf 配置文件[server]里，然后重启 Nginx 即可生效。
```relax-ng

if ($request_method !~* GET|POST) { return 444; }
#使用 444 错误代码可以更加减轻服务器负载压力。
#防止 SQL 注入
if ($query_string ~* (\$|'|--|[+|(%20)]union[+|(%20)]|[+|(%20)]insert[+|(%20)]|[+|(%20)]drop[+|(%20)]|[+|(%20)]truncate[+|(%20)]|[+|(%20)]update[+|(%20)]|[+|(%20)]from[+|(%20)]|[+|(%20)]grant[+|(%20)]|[+|(%20)]exec[+|(%20)]|[+|(%20)]where[+|(%20)]|[+|(%20)]select[+|(%20)]|[+|(%20)]and[+|(%20)]|[+|(%20)]or[+|(%20)]|[+|(%20)]count[+|(%20)]|[+|(%20)]exec[+|(%20)]|[+|(%20)]chr[+|(%20)]|[+|(%20)]mid[+|(%20)]|[+|(%20)]like[+|(%20)]|[+|(%20)]iframe[+|(%20)]|[\<|%3c]script[\>|%3e]|javascript|alert|webscan|dbappsecurity|style|confirm\(|innerhtml|innertext)(.*)$) { return 555; }
if ($uri ~* (/~).*) { return 501; }
if ($uri ~* (\\x.)) { return 501; }
#防止 SQL 注入
if ($query_string ~* "[;'<>].*") { return 509; }
if ($request_uri ~ " ") { return 509; }
if ($request_uri ~ (\/\.+)) { return 509; }
if ($request_uri ~ (\.+\/)) { return 509; }
 
#if ($uri ~* (insert|select|delete|update|count|master|truncate|declare|exec|\*|\')(.*)$ ) { return 503; }
#防止 SQL 注入
if ($request_uri ~* "(cost\()|(concat\()") { return 504; }
if ($request_uri ~* "[+|(%20)]union[+|(%20)]") { return 504; }
if ($request_uri ~* "[+|(%20)]and[+|(%20)]") { return 504; }
if ($request_uri ~* "[+|(%20)]select[+|(%20)]") { return 504; }
if ($request_uri ~* "[+|(%20)]or[+|(%20)]") { return 504; }
if ($request_uri ~* "[+|(%20)]delete[+|(%20)]") { return 504; }
if ($request_uri ~* "[+|(%20)]update[+|(%20)]") { return 504; }
if ($request_uri ~* "[+|(%20)]insert[+|(%20)]") { return 504; }
if ($query_string ~ "(<|%3C).*script.*(>|%3E)") { return 505; }
if ($query_string ~ "GLOBALS(=|\[|\%[0-9A-Z]{0,2})") { return 505; }
if ($query_string ~ "_REQUEST(=|\[|\%[0-9A-Z]{0,2})") { return 505; }
if ($query_string ~ "proc/self/environ") { return 505; }
if ($query_string ~ "mosConfig_[a-zA-Z_]{1,21}(=|\%3D)") { return 505; }
if ($query_string ~ "base64_(en|de)code\(.*\)") { return 505; }
if ($query_string ~ "[a-zA-Z0-9_]=http://") { return 506; }
if ($query_string ~ "[a-zA-Z0-9_]=(\.\.//?)+") { return 506; }
if ($query_string ~ "[a-zA-Z0-9_]=/([a-z0-9_.]//?)+") { return 506; }
if ($query_string ~ "b(ultram|unicauca|valium|viagra|vicodin|xanax|ypxaieo)b") { return 507; }
if ($query_string ~ "b(erections|hoodia|huronriveracres|impotence|levitra|libido)b") {return 507; }
if ($query_string ~ "b(ambien|bluespill|cialis|cocaine|ejaculation|erectile)b") { return 507; }
if ($query_string ~ "b(lipitor|phentermin|pro[sz]ac|sandyauer|tramadol|troyhamby)b") { return 507; }
#这里大家根据自己情况添加删减上述判断参数，cURL、wget 这类的屏蔽有点儿极端了，但要“宁可错杀一千，不可放过一个”。
if ($http_user_agent ~* YisouSpider|ApacheBench|WebBench|Jmeter|JoeDog|Havij|GetRight|TurnitinBot|GrabNet|masscan|mail2000|github|wget|curl|Java|python) { return 508; }
#同上，大家根据自己站点实际情况来添加删减下面的屏蔽拦截参数。
if ($http_user_agent ~* "Go-Ahead-Got-It") { return 508; }
if ($http_user_agent ~* "GetWeb!") { return 508; }
if ($http_user_agent ~* "Go!Zilla") { return 508; }
if ($http_user_agent ~* "Download Demon") { return 508; }
if ($http_user_agent ~* "Indy Library") { return 508; }
if ($http_user_agent ~* "libwww-perl") { return 508; }
if ($http_user_agent ~* "Nmap Scripting Engine") { return 508; }
if ($http_user_agent ~* "~17ce.com") { return 508; }
if ($http_user_agent ~* "WebBench*") { return 508; }
if ($http_user_agent ~* "spider") { return 508; } #这个会影响国内某些搜索引擎爬虫，比如：搜狗
#拦截各恶意请求的 UA，可以通过分析站点日志文件或者 waf 日志作为参考配置。
if ($http_referer ~* 17ce.com) { return 509; }
#拦截 17ce.com 站点测速节点的请求，所以明月一直都说这些测速网站的数据仅供参考不能当真的。
if ($http_referer ~* WebBench*") { return 509; }
#拦截 WebBench 或者类似压力测试工具，其他工具只需要更换名称即可。
```