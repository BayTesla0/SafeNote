Merhaba,


Bu proje sayesinde önemli notlarınızı güvenli bir şekilde saklayabilecek ve istediğiniz yerden erişebileceksiniz.

Amaç
Güvenli bir şekilde yazı saklamak ,not saklamak.Önemli şifre ve anahtarların güvende bir şekilde tutulması.

Yöntem 
Burada web üzerinden kişi kullalnıcı oluşturduktan sonra bu heaba giriş yapıp notlarını şifreli bir şekilde veritabanına saklayabilecek.Notlar bir şifreleme algoritması kullanılarka veritabında saklanacak.
kullanıcı istediği zaman kendina ait olan notarı tek seferde kalıcı olarak silebilecek.Bu  notlar geri getirilemez olacak.İşaret edilen veriye erişimin engellenmesi yöntemi değil ,direkt silme işlemi gerçkleşecek.
Kullanıcın notları tarihi ve saati ile beraber saklanacak.

Yapı


Kullanıcı Oluşturma
Burada kullanıcı girdi olarak ,kullanıcı adı ,şifre ve e postasını yazması istencek .
Kullanıcı adı şifre ve e postanın uygun şekilde , uygun uzunlukta doldurulması kontrıol edilecek.
ardından kullanıcı adının ve e postanın daha önce kullanılmadığını kontrol etmek için "google ajax" servisi kullanılacak.
Bu kontroller başarılı bir şekilde gerçekleştirilip son aşamayu gelinecek.
Bu aşamada kullanıcı adı ,epostası ve şifresi bir id ile beraber veritabanına eklenecek.
Bötylelikle kullanıcı giriş yapabilir olacak.


Kullanıcı Girişi
Kullanıcı kayıt olurken kullandığı bilgileri girecek.
Girdiği veriler konmtrol edilecek ilk kullanıcı adı getirilecek ve eğer kullanıcı adı şifrelenmiş "şifre" ile uyuşmuyorsa ,
kullanıcıya bir "allert" ile bu bildirilecek ve verileri doğru bir şekilde girmesi istenecek ,
eğer veriler uyuşuyorsa kullanıcıya oturum kimliği atayıp not alma işleminin yapılacağı sayfasına yönlendirilecek.


Not Sayfası
Bu sayfada yukardan aşşağı sırasıyla menu çubuğu ,not alma kısmı ve notlar bulunacak.
 Menü çubuğu
  Burada kullancının çıkış yapabileceği bir buton olacak.Bu butona tıklanırsa otturum kimliği sıfırlanacak ve giriş sayfasına yönlendirilecek.
  Ayrıca burada imha sayfasına gidecek olan buton bulunacak,bu buton silemyi temsil için kırmızı yapılacak.
 Metim Giriş Kısmı
  Buradan kullanıcı metnişni girebilecek .Girilen metin html ise bu çalıştırılmıyacak hale getirilecek.Uzun metinlerin sayfayı boznması önlenecek.
  Metin girildikten sonra alta bulunan butona tıklandığında bu metin uzunluğuna göre uyghun halde şifrelenip şu anın tarihini ve saatini de ekleyip veri tabanının "notlar" tablosuna saklanacak.
  Burada bu metinni bu kullanıcıya ait olduğunu göstermek için oturum kimlipğindeki "id" kullancıı id "foreing key" olarak "notlar" tablosunda saklanacak.
  Son olarak alt kısımda "Tarih ve Saat" ve "M""    
İmha Sayfası
