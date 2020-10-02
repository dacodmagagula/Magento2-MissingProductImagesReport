## Magento 2 Missing Product Images Report

This Magento 2 module creates an exportable grid in the admin backend with a list of all the visible products that do not have images linked to them.

<img src="https://dacod.co.za/images/missingproductimagesreport/dashboard.png" alt="dashboard">

## Features

1. Exportable

<img src="https://dacod.co.za/images/missingproductimagesreport/exporttocsv.png" alt="image of dashboard">
<br>
<img src="https://dacod.co.za/images/missingproductimagesreport/csv.png" alt="image of csv">

2. Filterable

<img src="https://dacod.co.za/images/missingproductimagesreport/filter.png" alt="filter">

## Installation Steps

1. Create a folder titled "Dacod" in your Magento `root/app/code`.

2. Under the folder above ("Dacod") create a folder titled "MissingProductImagesReport". All in all your folder structure from the Magento root folder should be `/app/code/Dacod/MissingProductImagesReport`.

3. Download the contents of this repository into the folder above ("MissingProductImagesReport").

4. From the Magento root folder, via the Command Line Interface run the following commands:


	A. `php bin/magento module:enable Dacod_MissingProductImagesReport`

	B. `php bin/magento setup:upgrade`

	C. `php bin/magento setup:static-content:deploy -f`

	D. `php bin/magento module:enable cache:clean`

5. Go to 'Catalog > Missing Product Images Report' on the backend.

<img src="https://dacod.co.za/images/missingproductimagesreport/link.png" alt="link to plugin from backend">

## License

You can use this code however you like (see LICENSE).
