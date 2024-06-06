# Job Capsule İşe Alım Yönetim Sistemi

Bu proje, bir işe alım sürecini yönetmek için tasarlanmış bir web uygulamasıdır. Kullanıcılar, kayıt olabilir, giriş yapabilir, iş ilanlarını görüntüleyebilir ve başvuruda bulunabilirler.                                         
Yöneticiler ise iş ilanları oluşturabilir, adayları yönetebilir, adayların süreç kontolünü yapabilir ve raporlar oluşturabilirler.

![uml-diagram](https://github.com/halecosar/Job_Capsule/assets/142445977/f8f6c28f-0562-4ecd-b506-0aef7349b2d9)



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
![login](https://github.com/halecosar/Job_Capsule/assets/142445977/5ed1d827-f553-495a-9b0e-e25812a32533)
![register](https://github.com/halecosar/Job_Capsule/assets/142445977/f804edba-399b-4d4e-83b9-58cd55d9593a)
![applications](https://github.com/halecosar/Job_Capsule/assets/142445977/9d7b2afa-1ac2-471b-a3d8-27616619207f)
![candidateProcessUpdate](https://github.com/halecosar/Job_Capsule/assets/142445977/8ef0dd30-9839-4a8b-9863-f658a7032393)
![recruiter-hp](https://github.com/halecosar/Job_Capsule/assets/142445977/dca8ada8-3b51-48f5-876c-9e8eb440dbb1)
![candidate-list](https://github.com/halecosar/Job_Capsule/assets/142445977/a0c6a571-e45c-4d88-b420-869e2d8130a8)




## License

[MIT](https://choosealicense.com/licenses/mit/)


