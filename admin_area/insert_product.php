
<?php
include("includes/db.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script>
        tinymce.init({selector:'textarea'});
    </script>
    <link rel="stylesheet" href="styles/bootstrap.min.css" media="all"/>
    <link rel="stylesheet" href="styles/style.css" media="all"/>
</head>
<body bgcolor="#999999">
    <form method="post" action="insert_product.php" enctype="multipart/form-data">
        <table width="700" align="center" border="1" bgcolor="#139187" >
            <tr align="center">
                
            <td colspan="2"><h1>Insert New Product</h1></td>    
                
            
            </tr>
            <tr>
               <td align="right"><b>Product Title</b></td>
                <td><input type="text" name="product_title" size="50" /></td>
                
                
            </tr>
            <tr>
               <td align="right"><b>Product Category</b></td>
                <td><select name="product_cat" id="">
                    <option>Select a Category</option>
                    <?php
           $get_cats = "select * from category";
           $run_cats = mysqli_query($con ,$get_cats);
     while ($row_cats=mysqli_fetch_array($run_cats)){
                
                $cat_id = $row_cats['cat_id'];
                 $cat_title = $row_cats['cat_title'];
               
          echo "<option value='$cat_id'>$cat_title</option>";
               }
           ?>
                </select></td>
                
                
            </tr>
            <tr>
               <td align="right"><b>Product Brand</b></td>
                <td><select name="product_brand" >
                    <option>Select a Brand</option>
                    <?php
           $get_brands = "select * from brands";
           $run_brands = mysqli_query($con ,$get_brands);
     while ($row_brands=mysqli_fetch_array($run_brands)){
                
                $brand_id = $row_brands['brand_id'];
                 $brand_title = $row_brands['brand_title'];
               
          echo "<option value='$brand_id'>$brand_title</option>";
               }
           ?>
                </select></td>
                
                
            </tr>
            
            <tr>
               <td align="right"><b>Product Image 1</b></td>
                <td><input type="file" name="product_img1" /></td>
                
                
            </tr>
            <tr>
               <td align="right"><b>Product Image 2</b></td>
                <td><input type="file" name="product_img2" /></td>
                
                
            </tr>
            <tr>
               <td align="right"><b>Product Image 3</b></td>
                <td><input type="file" name="product_img3" /></td>
                
                
            </tr>
            <tr>
               <td align="right"><b>Product Price</b></td>
                <td><input type="text" name="product_price" /></td>
                
                
            </tr>
            <tr>
               <td align="right"><b>Product Description</b></td>
                <td><textarea name="product_desc" id="" cols="50" rows="5"></textarea></td>
                
                
            </tr>
            <tr>
               <td align="right"><b>Product keywords</b></td>
                <td><input type="text" name="product_keywords" /></td>
                
                
            </tr>
            <tr align="center">
                <td colspan="2"><input type="submit" name="insert_product" class="btn btn-secondary text-white" value="Insert product"/></td>
                
                
            </tr>
            <tr align="center">
                <td colspan="2"><a href="view_products.php" style="margin-top:10px;margin-bottom:10px;" class="btn btn-secondary text-white"> View Products Here!</a></td>
                
            </tr>
        </table>
        
        
        
    </form>
    
</body>
</html>

<?php
   if (isset($_POST['insert_product'])) {

   	//Text data variables
   	  $product_title = $_POST['product_title'];
   	  $product_cat = $_POST['product_cat'];
      $product_brand = $_POST['product_brand'];
      $product_price = $_POST['product_price'];
      $product_desc = $_POST['product_desc'];
      $status = 'on';
      $product_keywords = $_POST['product_keywords'];

      //Image names 
       $product_img1 = $_FILES['product_img1']['name'];
       $product_img2 = $_FILES['product_img2']['name'];
       $product_img3 = $_FILES['product_img3']['name'];

      //Image temp names
        $temp_name1 = $_FILES['product_img1']['tmp_name'];
        $temp_name2 = $_FILES['product_img2']['tmp_name'];
        $temp_name3 = $_FILES['product_img3']['tmp_name'];

       if($product_title=='' OR $product_cat=='' OR $product_brand=='' OR $product_price=='' OR $product_desc=='' OR $product_keywords=='' OR $product_img1=='') {

       	 echo "<script>alert('Please Fill all the fields!')</script>";
       	 exit();
       	
       }

       else{
            global $con;
         //uploading images to its folder
          move_uploaded_file($temp_name1,"product_images/$product_img1");
          move_uploaded_file($temp_name2,"product_images/$product_img2");
          move_uploaded_file($temp_name3,"product_images/$product_img3");


         $insert_product = "insert into products (cat_id,brand_id,date,product_title,product_img1,product_img2,product_img3,product_price,product_desc,status) values ('$product_cat','$product_brand',NOW(),'$product_title','$product_img1','$product_img2','$product_img3','$product_price','$product_desc','$status')";

         $run_product = mysqli_query($con,$insert_product);

         if ($run_product) {
         	echo "<script>alert('Product inserted Successfully')</script>";
         }



   }

}

 
?>






