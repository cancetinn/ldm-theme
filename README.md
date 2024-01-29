# Arina Development Theme

Merhaba, bu Arina Digital için geliştirilmiş bir Wordpress Tema altyapısıdır.


# Klasörler

`assets` - 
İçeriği Gulp ile otomatik oluşturulan klasör (Site kaynağını buradan alır).

`dev` - Scss, Javascript, Img gibi dosyaların bulunduğu klasör. Ayrıca ***assets*** klasörü burayı referans alarak oluşturulur ve developer çalışmaları burada yapılır.

`framework` - Redux framework (Tema ayarları) gibi yardımcı eklentilerin konfigürasyonlarının yapıldığı kısım.

`inc` - classların, elementlerin, yardımcı dosyaların, mail yapısının bulunduğu klasör.

`templates` - Header, content, blog post, mail gibi template dosyalarının bulunduğu klasör.

# Yardımcı Fonksiyonlar

### getImage()
Görsel IDsi kullanılarak görselin yazdırılmasını sağlar.

`Örnek: echo getImage('1362', sizes:'blog_thumb')`
> **Not:** Php 8 sürümünden sonra gelen bir özellik ile parametreleri sırası ile yazarak fonksiyona göndermek zorunda değiliz. Örneğin fonksiyonun aldığı ***$sizes*** parametlesinin adı belirtilerek parametre direkt olarak gönderilebilir.

### getIcon()
Svg gibi dosyaların idsi kullanılarak `<i>` etiketine yazdırılmasını sağlar.

`Örnek: echo getIcon('4951')`


### getClassName()
Elementorda html etiketine dinamik bir class eklemek için `switch` kullanıldığında, ***getClassName*** aracılığı ile `element adını` ve `class adını` parametre olarak gönderdiğimizde ek sorgu yapmadan class adını alırız.

`Örnek: getClassName($settings['margin_bottom'], 'margin_bottom')`


### getTaxonomy()
Parametre gönderilmezse kategorileri array olarak listeler. Ancak bir parametre belirtilirse, o parametre adı ile belirtilen taksonomiyi array olarak listeler.

`Örnek: getTaxonomy('team_categories')`
> **Not:** Bu fonksiyon genelde Elementor'daki `\Elementor\Controls_Manager::SELECT2` ile kategorileri dropdown olarak listeleyip seçilebilir yapmak için kullanılır. Seçilen bir kategoriye ait postları listelemek için işlevseldir.

***Örnek :***
```
$this->add_control(
    'select_category',
    [
        'label' => 'Select category',
        'type' => \Elementor\Controls_Manager::SELECT2,
        'multiple' => false,
        'label_block' => true,
        'options' => getTaxonomy('team_categories'),
    ]
);
```

### getPages()
Bu fonksiyon ***getTaxonomy*** ile aynı işlevi görür, tek farkı sayfaları array olarak döndürmesidir.

`Örnek: getPages()`


### arina_option()
Redux framework ile oluşturulmuş bir alanın(field) değerini döndürür.

`Örnek: arina_option('footer_copyright')`


### arina_pagination()
Herhangi bir post döngüsünden sonra sayfalamayı göstermek için kullanılır.

`Örnek: arina_pagination()`


### menu_nav()
Wordpress menülerinin yapısını özelleştirilebilir yapmak için kullanılır.

`Örnek: menu_nav('top-menu')`


### arina_breadcrumbs()
Sayfa içi navigasyon linkleri oluşturmak için kullanılır.

`Örnek: arina_breadcrumbs()`


# Ajax işlemleri

**nonce** - Bu işlev ajax isteklerinde güvenliği sağlamak için kullanılır. Nonce spesifik olarak kullanılmak üzere `datanonce` idsine sahip bir DOM elemanında tutulmalı veya input hidden value değerine eklenmelidir.


**Ajax isteği için örnek nonce oluşturma (Spesifik eylemler için isimlendirme önemlidir):**
```
<div id="datanonce" data-nonce="<?php echo wp_create_nonce('contact_form_nonce'); ?>"></div>
```

**Örnek Javascript:**
```
const dataAjaxUrl = document.querySelector("#datajax").dataset.ajaxurl  
const dataNonce = document.querySelector("#datanonce").dataset.nonce

const formData = new FormData(contactForm)
formData.append('action', 'contact_form')
formData.append('security', dataNonce)

fetch(dataAjaxUrl, {  
	method: 'POST',  
	body: formData,  
})
```
> **Not:** ajaxurl footer kısmına bir DOM elemanı olarak her yerde kullanılmak üzere sabit bir şekilde eklenmiştir.
> ```<div id="datajax" data-ajaxurl="<?php echo admin_url('admin-ajax.php'); ?>"></div>```


**Callback fonksiyonu:**
```
public function contact_form() {  
	// check security  
	$nonce_check = check_ajax_referer('contact_form_nonce', 'security', false);  
	if (!$nonce_check) { // Hata Gösterimi }
	...
```
> **Not:** check_ajax_referer üç parametre alır. Birincisi DOM ile oluşturulan `wp_create_nonce('contact_form_nonce')` değeri, ikincisi formData ile gönderilen `'security'` değeri. üçüncü parametresi ise, `wp_die` fonksiyonunu kullanıp kullanmama seçeneğini belirtir.


## Gulp.js

Yüklenecek paketler

```
yarn add --dev browser-sync cross-env gulp gulp-clean gulp-concat gulp-html-replace gulp-htmlmin gulp-if gulp-rename gulp-sass gulp-sourcemaps gulp-uglify sass

```
