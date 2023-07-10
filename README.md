# Descriere

Aceast proiect constă într-o aplicație web optimizată pentru organizarea și cercetarea unui catalog de imagini încărcate de utilizatori. Aceste imagini pot fi creații proprii, sau generate de un model AI care va rula pe un server, care va comunica cu backend-ul aplicației. Astfel, fiecare va putea accesa această funcționalitate printr-o interfață simplă și intuivia, generând imagini prin introducerea unui prompt, adică o scurtă descriere. Printre alte funcționalități implementate se numără un sistem de conturi cu diferite privilegii, o pagină de administrare pentru a revoca sau imputernici utilizatorii prin drepturi, catalogul în care vor fi afișate dinamic toate imaginile existente și posibilitatea de a eticheta imaginile prin cuvinte-cheie, iar mai apoi de a le găsi prin interogări complexe, precum prezența unei etichete și lipsa alteia. De asemenea, pot fi adăugate comentarii și apreciate imaginile pentru a evidenția creațiile cele mai populare. În final, autorii imaginilor pot modifica etichetele propriilor imagini, iar moderatorii au dreptul de a șterge imaginile și comentariile altor utilizatori.

Schema bloc:

![image](https://github.com/alexmru/galerie_licenta/blob/main/bloc.jpg)


Pasi pentru instalare:


- Instalare XAMPP
https://www.apachefriends.org/


- Clonare repozitoriu in ../xampp/htdocs/


- Creare folder pentru imagini temp și temp


- Creare baza de date cu numele "aikive" și următoarele tabele



  * utilizatori, cu câmpurile user varchar(10), privilege int(1) și hash varchar(255)
  * likes, cu câmpurile id int(10), user varchar(10)
  * comments, cu câmpurile comment_id int(10) cu auto increment, user varchar(10), id int(10), data datetime și comment varchar(500)
  * imagini, cu câmpurile id int(10), url varchar(40), tags varchar(200), uploader varchar(100), sha256 varchar(64) și date date



- Instalare stable diffusion web ui conform instrucțiunilor de mai jos
https://github.com/AUTOMATIC1111/stable-diffusion-webui


- Adaugare în webui-user.bat la COMMANDLINEARGS: "--api", pentru activarea api-ului


- Pornire server Apache și MySQL în XAMPP


- Pornire server stable diffusion prin executarea webui-user.bat
