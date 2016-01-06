# Biomodels #

  * http://biomodels.caltech.edu
  * http://biomodels.caltech.edu/webservices

# How to use KEGG API through the Biological Web Services Proxy #

In order to use the service the following [Proxy parameters](http://code.google.com/p/bwsproxy/wiki/parameters) are requiered.

These parameters can be submited by GET or POST.

## Examples ##

> ### getModelsIdByUniprotId ###
  * http://bwsp.bioinfo.cnio.es/bwsp.php?bwsp_service=getModelsIdByUniprotId&bwsp_response_format=raw&bwsp_url=http://biomodels.caltech.edu/services?uniprotId=P04637

> ### getModelByID ###
  * http://bwsp.bioinfo.cnio.es/bwsp.php?bwsp_service=getModelByID&bwsp_response_format=raw&bwsp_url=http://biomodels.caltech.edu/services/BioModelsWebServices?id=BIOMD0000000188