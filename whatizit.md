# Whatizit #

  * http://www.ebi.ac.uk/webservices/whatizit/info.jsf

# How to use Whatizit through the Biological Web Services Proxy #

See the [Proxy parameters](http://code.google.com/p/bwsproxy/wiki/parameters)


Aditional parameters specific for this service are:

  * **service** (required)
  * **pipelineName** (required:  whatizit\_Abner, whatizitSwissprotGo, whatizitSwissprot, whatizitProteinInteraction, whatizitUkPmcGenesProteins, whatizitOscar3, whatizitSwissprotFilter, whatizitDisease, whatizitProteinInteractionPMID, whatizitQbmarsdf, whatizitProteinBiolexHuman, whatizitUkPmcGoterms, whatizitCheponer, whatizitCALBCFilterTerm, whatizitDiseaseUMLSDict, whatizitMetamap, whatizitUkPmcAll, whatizitOrganisms, whatizitEBIMed, whatizitMeshUp, whatizitPathwaywiki, whatizitOrganismsFilter, whatizitGORanked, whatizitUkPmcSpecies, whatizitDrugs, whatizitCALBCFilterId, whatizitSwissprotDisease, whatizitEBIMedDiseaseChemicals, whatizitISCN, whatizitChebiDict, whatizitChemicals, whatizitSwissprotGo2, whatizitGODict, whatizitProteinDiseaseUMLS)

  * **pmid**
  * **text**
  * **convertToHtml (boolean)**


These parameters can be submited by GET or POST.

## Examples ##

### queryPmid ###

http://bwsp.bioinfo.cnio.es/bwsp.php?bwsp_service=whatizit&bwsp_response_format=raw&bwsp_url=http://www.ebi.ac.uk/webservices/whatizit/ws?wsdl,service=queryPmid,pipelineName=whatizit_Abner,pmid=12091962

### contact ###

http://bwsp.bioinfo.cnio.es/bwsp.php?bwsp_service=whatizit&bwsp_response_format=raw&bwsp_url=http://www.ebi.ac.uk/webservices/whatizit/ws?wsdl,service=contact,pipelineName=whatizit_Abner,text=The imprinted gene, PEG3, confers parenting and sexual behaviors, alters growth and development, and regulates apoptosis. However, a molecular mechanism that can account for the diverse functions of Peg3/Pw1 is not known. To elucidate Peg3-regulated pathways, we performed a functional screen in zebrafish. Enforced overexpression of PEG3 mRNA during zebrafish embryogenesis decreased beta-catenin protein expression and inhibited Wnt-dependent tail development. Peg3/Pw1 also inhibited Wnt signaling in human cells by binding to beta-catenin and promoting its degradation via a p53/Siah1-dependent, GSK3beta-independent proteasomal pathway. The inhibition of the Wnt pathway by Peg3/Pw1 suggested a role in tumor suppression. Hypermethylation of the PEG3 promoter in primary human gliomas led to a loss of imprinting and decreased PEG3 mRNA expression that correlated with tumor grade. The decrease in Peg3/Pw1 protein expression increased beta-catenin, promoted proliferation and inhibited p53-dependent apoptosis in human CD133+ glioma stem cells. Thus, mammalian imprinting utilizes Peg3/Pw1 to co-opt the Wnt pathway, thereby regulating development and glioma growth&convertToHtml=fase