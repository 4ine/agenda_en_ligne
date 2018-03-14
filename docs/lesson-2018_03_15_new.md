# Cours du 08/03/2018

## Trigger de validation

```sql
DELIMITER $$
CREATE TRIGGER `client_nom_requis`
	BEFORE INSERT ON `clients` FOR EACH ROW
  BEGIN
	IF NEW.`nom` is null or NEW.`nom`='' THEN
		SIGNAL SQLSTATE VALUE '45000'
			SET MESSAGE_TEXT = '[table:clients] - le nom est obligatoire';
	END IF;
END;
$$
```

## Les plus hors scope du cours
