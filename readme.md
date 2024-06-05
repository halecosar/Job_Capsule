# Job Capsule İşe Alım Yönetim Sistemi

Bu proje, bir işe alım sürecini yönetmek için tasarlanmış bir web uygulamasıdır. Kullanıcılar, kayıt olabilir, giriş yapabilir, iş ilanlarını görüntüleyebilir ve başvuruda bulunabilirler.                                         
Yöneticiler ise iş ilanları oluşturabilir, adayları yönetebilir, adayların süreç kontolünü yapabilir ve raporlar oluşturabilirler.
## Kurulum Adımları


### Depoyu Klonlayın:

    git clone https://github.com/halecosar/Job_Capsule

### Veritabanı Bağlantısı:

libs/config.php dosyasını açın.
Veritabanı bilgilerinizi (servername, username, password, dbname) güncelleyin.

### Veritabanı Yapılandırması:

    database.sql dosyasını MySQL veritabanınıza import edin.
    Sunucu Kurulumu:

    PHP ve MySQL destekli bir sunucuya projeyi yükleyin (örneğin, XAMPP veya WAMP).
    


# Kullanım

## Kullanıcı Kayıt ve Giriş
### Kayıt Olma:
    1. Register.php sayfasına gidin.
    2. Tüm gerekli alanları doldurun ve formu gönderin.
    3. Başarılı bir kayıt sonrası giriş sayfasına yönlendirileceksiniz.
### Giriş Yapma:
    1. login.php sayfasına gidin.
    2. Kayıt olduğunuz e-posta ve şifre ile giriş yapın.
  ##  İş İlanları ve Başvuru
### İş İlanlarını Görüntüleme:
    1. Anasayfadan tüm iş ilanlarını görüntüleyebilirsiniz.
    2.  Detaylar için bir ilana tıklayın.
### İş İlanlarına Başvuru:
    1. Bir ilana başvurmak için giriş yapmış olmanız gerekmektedir.
    2. İlan detay sayfasından "Başvur" butonuna tıklayın.
## Yönetici İşlemleri
 ### İlan Oluşturma ve Yönetme:
    1. Giriş yaptıktan sonra yönetici paneline erişin.
    2. Yeni ilan oluşturabilir, mevcut ilanları güncelleyebilir veya silebilirsiniz.
### Aday Yönetimi:
    1. Tüm adayları listeleyebilir, güncelleyebilir, silebilir ve adayların CV'lerini görüntüleyebilirsiniz.
### Raporlama: 
    Başvuruları ve ilanları raporlayabilir, başvurular arasında filtreleme ve sayfalama yapabilirsiniz.





# Tech Stack
     Frontend: HTML, CSS (Bootstrap), JavaScript
     Backend: PHP
     Veritabanı: MySQL



## Screenshots

![App Screenshot](https://via.placeholder.com/468x300?text=App+Screenshot+Here)


## License

[MIT](https://choosealicense.com/licenses/mit/)

