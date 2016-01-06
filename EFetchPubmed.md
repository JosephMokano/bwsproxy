# EFetch PubMed #

http://www.ncbi.nlm.nih.gov/entrez/query/static/efetch_help.html

http://www.ncbi.nlm.nih.gov/entrez/query/static/esoap_help.html

# How to use EFetch PubMed through the Biological Web Services Proxy #

In order to use the service the following [Proxy parameters](http://code.google.com/p/bwsproxy/wiki/parameters) are requiered.

Aditional parameters specific for this service are:

  * **service** (required)
  * **db** (required)
  * **id**
  * **rettype**  (required)
  * **term** (required)
  * **field**
  * **reldate**

These parameters can be submited by GET or POST.

## Examples ##
In PubMed display PMID 12091962 in xml retrieval mode and abstract retrieval type:

http://bwsp.bioinfo.cnio.es/bwsp.php?bwsp_service=entrezUtils&bwsp_response_format=raw&bwsp_url=http://www.ncbi.nlm.nih.gov/entrez/eutils/soap/v2.0/efetch_pubmed.wsdl?service=eFetch,db=pubmed,id=12091962,retmode=xml,rettype=abstract


In PubMed display PMIDs in xml retrieval mode:

http://bwsp.bioinfo.cnio.es/bwsp.php?bwsp_service=entrezUtils&bwsp_response_format=raw&bwsp_url=http://www.ncbi.nlm.nih.gov/entrez/eutils/soap/v2.0/efetch_pubmed.wsdl?service=eFetch,db=pubmed,id=11748933,retmode=xml