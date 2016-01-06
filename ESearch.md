# ESearch #

http://eutils.ncbi.nlm.nih.gov/corehtml/query/static/esearch_help.html

http://www.ncbi.nlm.nih.gov/entrez/query/static/esoap_help.html

# How to use ESearch through the Biological Web Services Proxy #

In order to use the service the following [Proxy parameters](http://code.google.com/p/bwsproxy/wiki/parameters) are requiered.

Aditional parameters specific for this service are:

  * **service** (required)
  * **db** (required)
  * **rettype**  (required)
  * **term** (required)
  * **field**
  * **reldate**

These parameters can be submited by GET or POST.

## Examples ##

Search in PubMed for the term cancer for the entrez date from the last 60 days and retrieve the first 100 IDs and translations using the history parameter:

http://bwsp.bioinfo.cnio.es/bwsp.php?bwsp_service=entrezUtils&bwsp_response_format=raw&bwsp_url=http://www.ncbi.nlm.nih.gov/entrez/eutils/soap/v2.0/eutils.wsdl?service=eSearch,db=pubmed,term=cancer,reldate=60,datetype=edat,retmax=100,usehistory=y

Search in PubMed for the journal PNAS Volume 97, and retrieve 6 IDs starting at ID 7 using a tool parameter:

http://bwsp.bioinfo.cnio.es/bwsp.php?&bwsp_service=entrezUtils&bwsp_response_format=raw&bwsp_url=http://www.ncbi.nlm.nih.gov/entrez/eutils/soap/v2.0/eutils.wsdl?service=eSearch,db=pubmed,term=PNAS[ta]+AND+97[vi],retstart=6,retmax=6,tool=biomed3

Search in Journals for the term obstetrics:

http://bwsp.bioinfo.cnio.es/bwsp.php?&bwsp_service=entrezUtils&bwsp_response_format=raw&bwsp_url=http://www.ncbi.nlm.nih.gov/entrez/eutils/soap/v2.0/eutils.wsdl?service=eSearch,db=journals,term=obstetrics

Search in PubMed Central for stem cells in free fulltext articles:

http://bwsp.bioinfo.cnio.es/bwsp.php?&bwsp_service=entrezUtils&bwsp_response_format=raw&bwsp_url=http://www.ncbi.nlm.nih.gov/entrez/eutils/soap/v2.0/eutils.wsdl?service=eSearch,db=pmc,term=stem+cells+AND+free+fulltext[filter]



Search in Nucleotide for a property of the sequence:

http://bwsp.bioinfo.cnio.es/bwsp.php?&bwsp_service=entrezUtils&bwsp_response_format=raw&bwsp_url=http://www.ncbi.nlm.nih.gov/entrez/eutils/soap/v2.0/eutils.wsdl?service=eSearch,db=nucleotide,term=biomol+trna[prop]



Search in Protein for a molecular weight:

http://bwsp.bioinfo.cnio.es/bwsp.php?&bwsp_service=entrezUtils&bwsp_response_format=raw&bwsp_url=http://www.ncbi.nlm.nih.gov/entrez/eutils/soap/v2.0/eutils.wsdl?service=eSearch,db=protein,term=200020[molecular+weight]