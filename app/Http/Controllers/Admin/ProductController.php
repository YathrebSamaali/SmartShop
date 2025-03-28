<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; // Assurez-vous d'étendre Controller
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Afficher tous les produits
    // Dans votre contrôleur
public function index()
{
    $products = Product::paginate(4); // Au lieu de Product::all()
    return view('admin.products.index', compact('products'));
}

    // Afficher le formulaire de création de produit
    public function create()
    {
        return view('admin.products.create');
    }

    // Enregistrer un nouveau produit
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Gestion de l'image
        $imagePath = $this->handleImageUpload($request);

        $product = Product::create([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
            'stock' => $validatedData['stock'],
            'category' => $validatedData['category'],
            'image' => $imagePath
        ]);

        return redirect()->route('admin.products.index')
            ->with('success', 'Produit créé avec succès');
    }

    private function handleImageUpload(Request $request)
    {
        if (!$request->hasFile('image')) {
            return null;
        }

        // Générer un nom unique pour l'image
        $fileName = time().'_'.$request->file('image')->getClientOriginalName();

        // Stocker l'image dans le dossier public/storage/products
        return $request->file('image')->storeAs(
            'products',
            $fileName,
            'public'
        );
    }

    // Afficher les détails d'un produit
    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    // Afficher le formulaire de modification d'un produit
    public function edit($id)
{
    $product = Product::findOrFail($id);
    return view('admin.products.edit', compact('product'));
}


    // Mettre à jour un produit
    public function update(Request $request, $id) // Le paramètre $id est passé ici
    {
        // Récupérer le produit par ID
        $product = Product::findOrFail($id); // Utilisation de findOrFail pour récupérer le produit, ou erreur 404 si non trouvé

        // Validation des champs
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validation pour l'image
        ]);

        // Gestion de l'image
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image, si elle existe
            if ($product->image && Storage::exists($product->image)) {
                Storage::delete($product->image);
            }

            // Enregistrer la nouvelle image
            $imagePath = $request->file('image')->store('products', 'public'); // Stockage dans le dossier 'products'
        } else {
            // Si aucune image n'est envoyée, conserver l'ancienne image
            $imagePath = $product->image;
        }

        // Mise à jour du produit
        $product->update([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
            'stock' => $validatedData['stock'],
            'category' => $validatedData['category'],
            'image' => $imagePath, // Mise à jour de l'image
        ]);

        // Retourner vers la liste des produits avec un message de succès
        return redirect()->route('admin.products.index')->with('success', 'Produit mis à jour avec succès');
    }




    // Supprimer un produit
    public function destroy($id)
{
    // Récupérer le produit par son ID
    $product = Product::findOrFail($id);

    // Supprimer l'image associée si elle existe
    if ($product->image && Storage::exists($product->image)) {
        Storage::delete($product->image);
    }

    // Supprimer le produit de la base de données
    $product->delete();

    // Rediriger vers la liste des produits avec un message de succès
    return redirect()->route('admin.products.index')->with('success', 'Produit supprimé avec succès');
}

}
