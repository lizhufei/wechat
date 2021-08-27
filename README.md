###微信开发组件
- auth2.0获取微信用户信息接口 "official/authorizer/{company_id}";
- 二维模型里 model/Qr里有创建二维码code和图片的相关方法,直接调用;
```
    Qr::generateCode; Qr::generateQR; Qr::state
```  
- 门面方法 
```
    * 构建自定菜单
    public function buildMenus($company_id=null)
    * 消费通知
    public function consumerInform(string $toOpenid, array $data, $company_id=null)
    * 访客申请通知
    public function applyInform(string $toOpenid, array $data, $company_id=null)
    * 预约审核通知
    public function auditInform(string $toOpenid, array $data, $company_id=null)
    * 考勤通知
    public function attendanceInform(string $toOpenid, array $data, $company_id=null)
    * 绑定员工和公众号
    public function bindStaff(int $person_id, string $openid, $company_id=null)
    * 绑定访客和公众号 $data数据有(['nickname':微信昵称 sex:性别, head:微信头像] 都可为空)
    public function bindVisitor(string $openid, array $data)
     * 获取开门二维码图片
    public function createQR(int $appointment_id):string
```
