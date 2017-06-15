
# messageNote2.0
### 这是一个简单的用jquery+ajax+php+mysql完成的留言本升级版;
* 相比上一版本，此版本将用户表和留言信息表分成了两个mysql表（在数据库mymessage中）,两个表分别是：

     &nbsp;&nbsp;1. 用户信息表user_info。字段共4个，包括：id 用户名username 密码password 上一次登录时间last_time(登录时间格式为：YYYY年MM月DD日 HH:ii:ss),并且管理员admin对应密码666666的id值为1；
       
     &nbsp;&nbsp;2. 留言信息表message。字段包括：id 用户名username 密码password（该表密码默认都是default值）留言内容content 留言时间addate（时间格式同上）
       
* 新增利用session来做到同源的不同页面分享数据，管理员删除留言功能，用户赞踩功能等

