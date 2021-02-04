-- Query 1 Insert Tony Stak to clients dataBase
INSERT INTO 
    clients 
        ( clientFirstname, clientLastname, clientEmail, clientPassword, comment) 
    VALUES 
        ("Tony", "Stark", "tony@starkent.com", "Iam1ronM@n", "I am the real Ironman");

--Query 2 Modify Tony's clientLevel
UPDATE clients SET clientLevel = 3;

--Query 3 Modify GM Hummer  with Spacious interior
UPDATE inventory 
SET invDescription =  replace(invDescription, "small interior", "spacious interior")
WHERE invModel = "Hummer";

--Query 4 inner Join
SELECT inventory.invModel, carclassification.classificationName
FROM inventory
INNER JOIN carclassification ON inventory.classificationId = carclassification.classificationId
WHERE classificationName = "SUV";

--Query 5 delete Jeep Wrangler
DELETE
FROM inventory
WHERE invModel = "Wrangler";

--Query 6 update all record to add /phpmotors to path in invImage
UPDATE inventory
SET invImage=concat('/phpmotors',invImage) invThumbnail=concat('/phpmotors',invThumbnail);