# Sequence Synonyms #

http://www.ebi.ac.uk/Tools/webservices/services/ncbiblast

# How to use Sequence Synonyms through the Biological Web Services Proxy #

In order to use the service the following [Proxy parameters](http://code.google.com/p/bwsproxy/wiki/parameters) are requiered.

Aditional parameters specific for this service are:
  * **program**
  * **database**
  * **sequence** (required)

These parameters can be submited by GET or POST.

## Examples ##

http://bwsp.bioinfo.cnio.es/bwsp.php?bwsp_service=ssynonyms&bwsp_response_format=raw&bwsp_url=http://ws.bioinfo.cnio.es/rest/ssynonyms/index.php?database=em_rel_syn,sequence=ATGAAAACTCCCGAAGACTGCACCGGCCTGGCGGACATCCGCGAGGCCATCGACCGGAT