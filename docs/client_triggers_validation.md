```sql
DELIMITER $$
CREATE TRIGGER `client_insert_nom_requis`
	BEFORE INSERT ON `clients` FOR EACH ROW
  BEGIN
	 IF NEW.`nom` is null or NEW.`nom`='' THEN
		SIGNAL SQLSTATE VALUE '45000'
			SET MESSAGE_TEXT = 'Le nom est obligatoire';
	END IF;
END;

CREATE TRIGGER `client_update_nom_requis`
	BEFORE UPDATE ON `clients` FOR EACH ROW
  BEGIN
	 IF NEW.`nom` is null or NEW.`nom`='' THEN
		SIGNAL SQLSTATE VALUE '45000'
			SET MESSAGE_TEXT = 'Le nom est obligatoire';
	END IF;
END;

CREATE TRIGGER `client_insert_prenom_requis`
	BEFORE INSERT ON `clients` FOR EACH ROW
  BEGIN
	 IF NEW.`prenom` is null or NEW.`prenom`='' THEN
		SIGNAL SQLSTATE VALUE '45000'
			SET MESSAGE_TEXT = 'Le prenom est obligatoire';
	END IF;
END;

CREATE TRIGGER `client_update_prenom_requis`
	BEFORE UPDATE ON `clients` FOR EACH ROW
  BEGIN
	 IF NEW.`prenom` is null or NEW.`prenom`='' THEN
		SIGNAL SQLSTATE VALUE '45000'
			SET MESSAGE_TEXT = 'Le prenom est obligatoire';
	END IF;
END;

CREATE TRIGGER `client_insert_genre_requis`
	BEFORE INSERT ON `clients` FOR EACH ROW
  BEGIN
	 IF NEW.`genre` is null or NEW.`genre`='' THEN
		SIGNAL SQLSTATE VALUE '45000'
			SET MESSAGE_TEXT = 'Le genre est obligatoire';
	END IF;
END;

CREATE TRIGGER `client_update_genre_requis`
	BEFORE UPDATE ON `clients` FOR EACH ROW
  BEGIN
	 IF NEW.`genre` is null or NEW.`genre`='' THEN
		SIGNAL SQLSTATE VALUE '45000'
			SET MESSAGE_TEXT = 'Le genre est obligatoire';
	END IF;
END;

CREATE TRIGGER `client_insert_ddn_requis`
	BEFORE INSERT ON `clients` FOR EACH ROW
  BEGIN
	 IF NEW.`date_de_naissance` is null or NEW.`date_de_naissance`='' THEN
		SIGNAL SQLSTATE VALUE '45000'
			SET MESSAGE_TEXT = 'La date de naissance est obligatoire';
	END IF;
END;

CREATE TRIGGER `client_update_ddn_requis`
	BEFORE UPDATE ON `clients` FOR EACH ROW
  BEGIN
	 IF NEW.`date_de_naissance` is null or NEW.`date_de_naissance`='' THEN
		SIGNAL SQLSTATE VALUE '45000'
			SET MESSAGE_TEXT = 'La date de naissance est obligatoire';
	END IF;
END;

CREATE TRIGGER `client_insert_email_requis`
	BEFORE INSERT ON `clients` FOR EACH ROW
  BEGIN
	 IF NEW.`email` is null or NEW.`email`='' THEN
		SIGNAL SQLSTATE VALUE '45000'
			SET MESSAGE_TEXT = 'Le email est obligatoire';
	END IF;
END;

CREATE TRIGGER `client_update_email_requis`
	BEFORE UPDATE ON `clients` FOR EACH ROW
  BEGIN
	 IF NEW.`email` is null or NEW.`email`='' THEN
		SIGNAL SQLSTATE VALUE '45000'
			SET MESSAGE_TEXT = 'Le email est obligatoire';
	END IF;
END;

CREATE TRIGGER `client_insert_telephone_requis`
	BEFORE INSERT ON `clients` FOR EACH ROW
  BEGIN
	 IF NEW.`telephone` is null or NEW.`telephone`='' THEN
		SIGNAL SQLSTATE VALUE '45000'
			SET MESSAGE_TEXT = 'Le telephone est obligatoire';
	END IF;
END;

CREATE TRIGGER `client_update_telephone_requis`
	BEFORE UPDATE ON `clients` FOR EACH ROW
  BEGIN
	 IF NEW.`telephone` is null or NEW.`telephone`='' THEN
		SIGNAL SQLSTATE VALUE '45000'
			SET MESSAGE_TEXT = 'Le telephone est obligatoire';
	END IF;
END;

$$

```




BEGIN
	IF NEW.`genre` not in(0,1,2,3) THEN
		SIGNAL SQLSTATE VALUE '45000'
			SET MESSAGE_TEXT = 'le genre n est pas valide.';
	END IF;
END

BEGIN
	IF NEW.`genre` not between 0 and 3 THEN
		SIGNAL SQLSTATE VALUE '45000'
			SET MESSAGE_TEXT = 'le genre est invalide.';
	END IF;
END



BEGIN
	IF NEW.`email` NOT REGEXP '^[^@]+@[^@]+.[^@]{2,}$' THEN
		SIGNAL SQLSTATE VALUE '45000'
			SET MESSAGE_TEXT = 'l'adresse email n'est pas valide.';
	END IF;
END
