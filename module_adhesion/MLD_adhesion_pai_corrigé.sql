CREATE TABLE adhesion_adherent 
	(adh_id int NOT NULL, 
	adh_nom varchar(40), 
	adh_prenom varchar(30), 
	adh_adresse varchar(100), 
	adh_code_postal varchar(10), 
	adh_ville varchar(30), 
	adh_pays varchar(20), 
	adh_sexe char(1), 
	adh_email varchar(100), 
	adh_pseudo varchar(30), 
	adh_date_naissance date, 
	adh_telephone_fixe varchar(14), 
	adh_telephone_portable varchar(14));  
	
CREATE TABLE adhesion_groupe 
	(gr_id int NOT NULL, 
	gr_name varchar(30), 
	gr_description varchar(255), 
	gr_web varchar(100), 
	gr_irc varchar(30));  

CREATE TABLE adhesion_session 
	(ses_id int NOT NULL, 
	ses_annee_civ varchar(10), 
	ses_annee_scol varchar(10));  
	
CREATE TABLE adhesion_paiement 
	(pai_id int NOT NULL, 
	pai_montant float, 
	pai_date date, 
	pai_comments varchar(100), 
	pai_reference varchar(20), 
	pai_type int);  
	
CREATE TABLE adhesion_cotisation 
	(adh_id int NOT NULL, 
	ses_id int NOT NULL, 
	gr_id int NOT NULL, 
	pai_id int NOT NULL, 
	cot_adh_statut int, cot_adh_gerant bool);  
	
CREATE TABLE adhesion_cotisation_groupe 
	(gr_id int NOT NULL, 
	ses_id int NOT NULL, 
	cot_gr_statut varchar(20), 
	cot_gr_type varchar(20), 
	cot_gr_montant float);  
	

ALTER TABLE adhesion_adherent ADD CONSTRAINT PK_adhesion_adherent PRIMARY KEY (adh_id);  

ALTER TABLE adhesion_groupe ADD CONSTRAINT PK_adhesion_groupe PRIMARY KEY (gr_id);  

ALTER TABLE adhesion_session ADD CONSTRAINT PK_adhesion_session PRIMARY KEY (ses_id);  

ALTER TABLE adhesion_paiement ADD CONSTRAINT PK_adhesion_paiement PRIMARY KEY (pai_id);  

ALTER TABLE adhesion_cotisation ADD CONSTRAINT PK_adhesion_cotisation PRIMARY KEY (adh_id, ses_id, gr_id, pai_id);  
ALTER TABLE adhesion_cotisation ADD CONSTRAINT FK_adhesion_cotisation_adh_id FOREIGN KEY (adh_id) REFERENCES adhesion_adherent (adh_id);  
ALTER TABLE adhesion_cotisation ADD CONSTRAINT FK_adhesion_cotisation_ses_id FOREIGN KEY (ses_id) REFERENCES adhesion_session (ses_id);  
ALTER TABLE adhesion_cotisation ADD CONSTRAINT FK_adhesion_cotisation_gr_id FOREIGN KEY (gr_id) REFERENCES adhesion_groupe (gr_id);  
ALTER TABLE adhesion_cotisation ADD CONSTRAINT FK_adhesion_cotisation_pai_id FOREIGN KEY (pai_id) REFERENCES adhesion_paiement (pai_id);

ALTER TABLE adhesion_cotisation_groupe ADD CONSTRAINT PK_adhesion_cotisation_groupe PRIMARY KEY (gr_id, ses_id);  
ALTER TABLE adhesion_cotisation_groupe ADD CONSTRAINT FK_adhesion_cotisation_groupe_gr_id FOREIGN KEY (gr_id) REFERENCES adhesion_groupe (gr_id);  
ALTER TABLE adhesion_cotisation_groupe ADD CONSTRAINT FK_adhesion_cotisation_groupe_ses_id FOREIGN KEY (ses_id) REFERENCES adhesion_session (ses_id);