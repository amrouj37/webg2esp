<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    



<div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Ajouter un Quiz</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="addQuiz.php">
                        
            
                        <div class="form-group">
                            <label for="categorie">Catégorie</label>
                            <input type="text" class="form-control" id="categorie" name="categorie" placeholder="Entrez la catégorie" required>
                        </div>
            
                        <div class="form-group">
                            <label for="dateCreation">Date de Création</label>
                            <input type="date" class="form-control" id="dateCreation" name="date_creation" required>
                        </div>
            
                        <div class="form-group">
                            <label for="titre">Titre</label>
                            <input type="text" class="form-control" id="titre" name="titre" placeholder="Entrez le titre" required>
                        </div>
            
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" placeholder="Entrez une description" rows="3" required></textarea>
                        </div>
            
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </form>
                </div>
            </div>
     </body>
     </html>            
            