/*==============================================================*/
/* Nom de SGBD :  MySQL 5.0                                     */
/* Date de cr�ation :  15/03/2021 11:46:33                      */
/*==============================================================*/

/*==============================================================*/
/* Table : CLASSE                                               */
/*==============================================================*/
create table CLASSE
(
   ID_CLASSE            INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
   NBINSCRIT               int not null,
   LIBELLECL            text not null
) ENGINE=InnoDB;

/*==============================================================*/
/* Table : EMPRUNTER                                            */
/*==============================================================*/
create table EMPRUNTER
(
   ID_ETUDIANT          INT NOT NULL,
   ID_LIVRE             INT NOT NULL,
   DATESORTIE           date not null,
   DATERETOUR           date not null,
   RETOURNER            tinyint DEFAULT '1'
) ENGINE=InnoDB;

/*==============================================================*/
/* Table : ETUDIANT                                             */
/*==============================================================*/
create table ETUDIANT
(
   ID_ETUDIANT          INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
   ID_CLASSE            int not null,
   MATRICULE            text not null,
   NOM                  text not null,
   PRENOM               text not null,
   ADRESSE              text not null,
   PHOTO                text not null
) ENGINE=InnoDB;

/*==============================================================*/
/* Table : LIVRE                                                */
/*==============================================================*/
create table LIVRE
(
   ID_LIVRE             INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
   TITREL               text not null,
   AUTEURL              text not null,
   GENREL               varchar(200) not null,
   NPAGEL               int not null,
   DESCRIPTION          text not null,
   NBEXEMPLAIRE         int not null DEFAULT '0',
   NBEMPRUNTER          int not null DEFAULT '0',
   PHOTO                text not null
) ENGINE=InnoDB;

alter table EMPRUNTER add constraint FK_EMPRUNTE_EMPRUNTER_LIVRE foreign key (ID_LIVRE)
      references LIVRE (ID_LIVRE) on delete restrict on update restrict;

alter table EMPRUNTER add constraint FK_EMPRUNTE_EMPRUNTER_ETUDIANT foreign key (ID_ETUDIANT)
      references ETUDIANT (ID_ETUDIANT) on delete restrict on update restrict;

alter table ETUDIANT add constraint FK_ETUDIANT_INSCRIT_CLASSE foreign key (ID_CLASSE)
      references CLASSE (ID_CLASSE) on delete restrict on update restrict;

