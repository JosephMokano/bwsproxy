# EFetchSeq #

http://www.ncbi.nlm.nih.gov/entrez/query/static/esoap_help.html

http://www.ncbi.nlm.nih.gov/corehtml/query/static/efetchseq_help.html

# How to use EfetchSeq through the Biological Web Services Proxy #

In order to use the service the following [Proxy parameters](http://code.google.com/p/bwsproxy/wiki/parameters) are requiered.

Aditional parameters specific for this service are:

  * **db** (Default: genome)
  * **rettype** (Default: native)
  * **id** (required)

These parameters can be submited by GET or POST.

## Examples ##

http://bwsp.bioinfo.cnio.es/bwsp.php?&bwsp_service=efetchSeq&bwsp_response_format=json&bwsp_url=http://www.ncbi.nlm.nih.gov/entrez/eutils/soap/v2.0/efetch_seq.wsdl,id=X82644