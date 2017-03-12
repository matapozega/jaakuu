drop database if exists jaakuu;
create database jaakuu character set utf8 collate utf8_general_ci;
use jaakuu;

ALTER DATABASE CHARACTER SET utf8 COLLATE utf8_unicode_ci;

create table korisnik (
sifra int not null primary key auto_increment,
email varchar(255) not null,
lozinka varchar(32) not null, 
ime varchar(50) not null, 
prezime varchar(50) not null,
oib char(11) not null,
datrodenja date not null,
ulica varchar(50) not null,
mjesto varchar(50) not null,
drzava varchar(50) not null,
postanskibr varchar(10) not null,
uloga varchar(50) null,
aktivan boolean not null
) engine=InnoDB;

create table listic (
sifra int not null primary key auto_increment,
status boolean not null,
korisnik int not null,
uplata decimal(5,2) not null,
ukupnikoeficijent decimal(5,2) not null,
evdobitak decimal(9,2) not null
) engine=InnoDB;

create table listic_ponuda (
listic int not null,
ponuda int not null,
koeficijent decimal(5,2)
) engine=InnoDB;

create table ponuda (
sifra int not null primary key auto_increment,
naziv varchar(50) not null,
video int not null,
tipponude int not null,
trajeod datetime not null,
trajedo datetime not null,
koeficijent decimal(5,2) not null,
kolicina int not null
) engine=InnoDB;

create table tipponude(
sifra int not null primary key auto_increment,
naziv varchar(50) not null,
opis text null
) engine=InnoDB;

create table video (
sifra int not null primary key auto_increment,
videoid varchar(255) not null,
naziv varchar(255) not null, 
pregleda int(50) not null,
likes int not null,
dislikes int not null, 
datum datetime null
) engine=InnoDB;

create table novcanik (
sifra int not null primary key auto_increment,
korisnik int not null,
stanje decimal(8,2) not null,
valuta varchar(20) not null
) engine=InnoDB;


alter table listic_ponuda add foreign key (listic) references listic(sifra);
alter table listic_ponuda add foreign key (ponuda) references ponuda(sifra);
alter table listic add foreign key (korisnik) references korisnik(sifra);
alter table ponuda add foreign key (tipponude) references tipponude(sifra);
alter table ponuda add foreign key (video) references video(sifra);
alter table novcanik add foreign key (korisnik) references korisnik(sifra);

